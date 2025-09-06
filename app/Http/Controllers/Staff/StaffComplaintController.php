<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\User;
use App\Events\ComplaintUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class StaffComplaintController extends Controller
{
    /**
     * Display a listing of complaints for staff
     */
    public function index(Request $request)
    {
        $query = Complaint::with(['user', 'assignedUser']);
        
        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('ticket_number', 'like', "%{$search}%")
                  ->orWhere('complainant_name', 'like', "%{$search}%")
                  ->orWhere('complainant_email', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        
        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
        
        // Filter by priority
        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }
        
        // Filter by assigned user
        if ($request->filled('assigned_to')) {
            $query->where('assigned_to', $request->assigned_to);
        }
        
        // Date range filter
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
        
        $complaints = $query->orderBy('created_at', 'desc')->paginate(10);
        
        // Get filter options
        $staffUsers = User::role('staff')->get();
        $categories = Complaint::distinct('category')->pluck('category');
        $priorities = ['low', 'medium', 'high', 'urgent'];
        $statuses = ['open', 'in_progress', 'resolved', 'closed'];
        
        // Statistics
        $stats = [
            'total' => Complaint::count(),
            'open' => Complaint::where('status', 'open')->count(),
            'in_progress' => Complaint::where('status', 'in_progress')->count(),
            'resolved' => Complaint::where('status', 'resolved')->count(),
            'closed' => Complaint::where('status', 'closed')->count(),
        ];
        
        return view('staff.complaints.index', compact(
            'complaints', 'staffUsers', 'categories', 'priorities', 'statuses', 'stats'
        ));
    }
    
    /**
     * Display the specified complaint
     */
    public function show(Complaint $complaint)
    {
        $complaint->load(['user', 'assignedUser']);
        
        // Get all staff users for assignment dropdown
        $staffUsers = User::role('staff')->get();
        
        return view('staff.complaints.show', compact('complaint', 'staffUsers'));
    }
    
    /**
     * Update complaint status
     */
    public function updateStatus(Request $request, Complaint $complaint)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:open,in_progress,resolved,closed',
            'response' => 'nullable|string|max:1000'
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }
        
        try {
            DB::beginTransaction();
            
            // Store old status for comparison
            $oldStatus = $complaint->status;
            
            $complaint->update([
                'status' => $request->status,
                'response' => $request->response,
                'responded_at' => $request->status === 'resolved' ? now() : $complaint->responded_at
            ]);
            
            // Trigger event if status changed
            if ($oldStatus !== $complaint->status) {
                event(new ComplaintUpdated($complaint, $oldStatus, $complaint->status));
            }
            
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'Status pengaduan berhasil diperbarui'
            ]);
            
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui status'
            ], 500);
        }
    }
    
    /**
     * Update complaint priority
     */
    public function updatePriority(Request $request, Complaint $complaint)
    {
        $validator = Validator::make($request->all(), [
            'priority' => 'required|in:low,medium,high,urgent'
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }
        
        try {
            $complaint->update([
                'priority' => $request->priority
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Prioritas pengaduan berhasil diperbarui'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui prioritas'
            ], 500);
        }
    }
    
    /**
     * Assign complaint to staff
     */
    public function assign(Request $request, Complaint $complaint)
    {
        $validator = Validator::make($request->all(), [
            'assigned_to' => 'required|exists:users,id'
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }
        
        try {
            $complaint->update([
                'assigned_to' => $request->assigned_to
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Pengaduan berhasil ditugaskan'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menugaskan pengaduan'
            ], 500);
        }
    }
}