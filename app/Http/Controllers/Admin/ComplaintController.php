<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\User;
use App\Events\ComplaintUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ComplaintController extends Controller
{
    // Middleware ditangani di route level

    public function index(Request $request)
    {
        $query = Complaint::with(['user', 'assignedUser'])->latest();

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan kategori
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter berdasarkan prioritas
        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        // Filter berdasarkan assigned user
        if ($request->filled('assigned_to')) {
            if ($request->assigned_to === 'unassigned') {
                $query->whereNull('assigned_to');
            } else {
                $query->where('assigned_to', $request->assigned_to);
            }
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('ticket_number', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%")
                  ->orWhere('complainant_name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $complaints = $query->paginate(15)->appends($request->query());

        // Statistics
        $stats = [
            'total' => Complaint::count(),
            'open' => Complaint::where('status', 'open')->count(),
            'in_progress' => Complaint::where('status', 'in_progress')->count(),
            'resolved' => Complaint::where('status', 'resolved')->count(),
            'closed' => Complaint::where('status', 'closed')->count(),
            'unassigned' => Complaint::whereNull('assigned_to')->count(),
        ];

        // Get staff users for assignment
        $staffUsers = User::role(['admin', 'staff'])->get();

        return view('admin.complaints.index', compact('complaints', 'stats', 'staffUsers'));
    }

    public function show(Complaint $complaint)
    {
        $complaint->load(['user', 'assignedUser']);
        
        // Get all staff users for assignment dropdown
        $staffUsers = User::role('staff')->get();
        
        // Debug: Log user roles
        $user = Auth::user();
        \Log::info('User accessing complaint show:', [
            'user_id' => $user->id,
            'user_email' => $user->email,
            'user_roles' => $user->roles->pluck('name')->toArray(),
            'has_staff_role' => $user->hasRole('staff'),
            'request_url' => request()->url()
        ]);
        
        // Check user role and return appropriate view
        if ($user->hasRole('staff')) {
            return view('staff.complaints.show', compact('complaint', 'staffUsers'));
        }
        
        return view('admin.complaints.show', compact('complaint', 'staffUsers'));
    }

    public function updateStatus(Request $request, Complaint $complaint)
    {
        $validated = $request->validate([
            'status' => 'required|in:open,in_progress,resolved,closed',
            'admin_notes' => 'nullable|string',
        ]);

        // Store old status for comparison
        $oldStatus = $complaint->status;

        $complaint->update([
            'status' => $validated['status'],
            'admin_notes' => $validated['admin_notes'] ?? $complaint->admin_notes,
            'updated_by' => Auth::id(),
        ]);

        // Trigger event if status changed
        if ($oldStatus !== $complaint->status) {
            event(new ComplaintUpdated($complaint, $oldStatus, $complaint->status));
        }

        return redirect()->route('admin.complaints.show', $complaint)
            ->with('success', 'Status pengaduan berhasil diperbarui.');
    }

    public function updatePriority(Request $request, Complaint $complaint)
    {
        $validated = $request->validate([
            'priority' => 'required|in:low,medium,high,urgent',
        ]);

        $complaint->update([
            'priority' => $validated['priority'],
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('admin.complaints.show', $complaint)
            ->with('success', 'Prioritas pengaduan berhasil diperbarui.');
    }

    public function assign(Request $request, Complaint $complaint)
    {
        $validated = $request->validate([
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        $complaint->update([
            'assigned_to' => $validated['assigned_to'],
            'updated_by' => Auth::id(),
        ]);

        $assignedUser = $validated['assigned_to'] ? User::find($validated['assigned_to']) : null;

        $message = $assignedUser 
            ? 'Pengaduan berhasil ditugaskan ke ' . $assignedUser->name
            : 'Penugasan pengaduan berhasil dibatalkan.';
            
        return redirect()->route('admin.complaints.show', $complaint)
            ->with('success', $message);
    }

    public function bulkUpdate(Request $request)
    {
        $validated = $request->validate([
            'complaint_ids' => 'required|array',
            'complaint_ids.*' => 'exists:complaints,id',
            'action' => 'required|in:status,priority,assign,delete',
            'value' => 'required',
        ]);

        $complaints = Complaint::whereIn('id', $validated['complaint_ids']);
        $count = $complaints->count();

        switch ($validated['action']) {
            case 'status':
                // Get complaints with old status for events
                $complaintsWithOldStatus = $complaints->get()->map(function($complaint) {
                    return ['complaint' => $complaint, 'oldStatus' => $complaint->status];
                });
                
                $complaints->update([
                    'status' => $validated['value'],
                    'updated_by' => Auth::id(),
                ]);
                
                // Trigger events for each complaint
                foreach ($complaintsWithOldStatus as $item) {
                    if ($item['oldStatus'] !== $validated['value']) {
                        event(new ComplaintUpdated($item['complaint']->fresh(), $item['oldStatus'], $validated['value']));
                    }
                }
                
                $message = "Status {$count} pengaduan berhasil diperbarui.";
                break;

            case 'priority':
                $complaints->update([
                    'priority' => $validated['value'],
                    'updated_by' => Auth::id(),
                ]);
                $message = "Prioritas {$count} pengaduan berhasil diperbarui.";
                break;

            case 'assign':
                $assignedTo = $validated['value'] === 'unassign' ? null : $validated['value'];
                $complaints->update([
                    'assigned_to' => $assignedTo,
                    'updated_by' => Auth::id(),
                ]);
                $message = $assignedTo 
                    ? "{$count} pengaduan berhasil ditugaskan."
                    : "Penugasan {$count} pengaduan berhasil dibatalkan.";
                break;

            case 'delete':
                // Delete attachments first
                foreach ($complaints->get() as $complaint) {
                    if ($complaint->attachments) {
                        foreach ($complaint->attachments as $attachment) {
                            Storage::disk('public')->delete($attachment['path']);
                        }
                    }
                }
                $complaints->delete();
                $message = "{$count} pengaduan berhasil dihapus.";
                break;
        }

        return response()->json([
            'success' => true,
            'message' => $message,
        ]);
    }

    public function saveNotes(Request $request, Complaint $complaint)
    {
        $validated = $request->validate([
            'admin_notes' => 'required|string',
        ]);

        $complaint->update([
            'admin_notes' => $validated['admin_notes'],
            'updated_by' => Auth::id(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Catatan berhasil disimpan.',
        ]);
    }

    public function destroy(Complaint $complaint)
    {
        // Delete attachments
        if ($complaint->attachments) {
            foreach ($complaint->attachments as $attachment) {
                Storage::disk('public')->delete($attachment['path']);
            }
        }

        $complaint->delete();

        return redirect()->route('admin.complaints.index')
            ->with('success', 'Pengaduan berhasil dihapus.');
    }

    public function export(Request $request)
    {
        $query = Complaint::with(['user', 'assignedUser']);

        // Apply same filters as index
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }
        if ($request->filled('assigned_to')) {
            if ($request->assigned_to === 'unassigned') {
                $query->whereNull('assigned_to');
            } else {
                $query->where('assigned_to', $request->assigned_to);
            }
        }
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('ticket_number', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%")
                  ->orWhere('complainant_name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $complaints = $query->get();

        $filename = 'pengaduan_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($complaints) {
            $file = fopen('php://output', 'w');
            
            // Add BOM for UTF-8
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // Header
            fputcsv($file, [
                'No Tiket',
                'Nama Pengadu',
                'Email',
                'Telepon',
                'Alamat',
                'Subjek',
                'Kategori',
                'Prioritas',
                'Status',
                'Ditugaskan Ke',
                'Tanggal Dibuat',
                'Tanggal Diperbarui',
            ]);
            
            foreach ($complaints as $complaint) {
                fputcsv($file, [
                    $complaint->ticket_number,
                    $complaint->complainant_name,
                    $complaint->complainant_email,
                    $complaint->complainant_phone,
                    $complaint->complainant_address,
                    $complaint->subject,
                    ucfirst($complaint->category),
                    ucfirst($complaint->priority),
                    ucfirst($complaint->status),
                    $complaint->assignedUser ? $complaint->assignedUser->name : 'Belum ditugaskan',
                    $complaint->created_at->format('d/m/Y H:i'),
                    $complaint->updated_at->format('d/m/Y H:i'),
                ]);
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function dashboard()
    {
        $stats = [
            'total' => Complaint::count(),
            'today' => Complaint::whereDate('created_at', today())->count(),
            'open' => Complaint::where('status', 'open')->count(),
            'in_progress' => Complaint::where('status', 'in_progress')->count(),
            'resolved' => Complaint::where('status', 'resolved')->count(),
            'closed' => Complaint::where('status', 'closed')->count(),
            'unassigned' => Complaint::whereNull('assigned_to')->count(),
            'my_assigned' => Complaint::where('assigned_to', Auth::id())->count(),
        ];

        // Recent complaints
        $recentComplaints = Complaint::with(['user', 'assignedUser'])
            ->latest()
            ->limit(10)
            ->get();

        // Complaints by category
        $complaintsByCategory = Complaint::selectRaw('category, count(*) as count')
            ->groupBy('category')
            ->pluck('count', 'category')
            ->toArray();

        // Complaints by priority
        $complaintsByPriority = Complaint::selectRaw('priority, count(*) as count')
            ->groupBy('priority')
            ->pluck('count', 'priority')
            ->toArray();

        return view('admin.complaints.dashboard', compact(
            'stats', 
            'recentComplaints', 
            'complaintsByCategory', 
            'complaintsByPriority'
        ));
    }
}