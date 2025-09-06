<?php

namespace App\Http\Controllers;

use App\Events\ComplaintCreated;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ComplaintController extends Controller
{
    public function index(Request $request)
    {
        $query = Complaint::with(['user', 'assignedUser'])
            ->when(Auth::check() && Auth::user()->hasRole('user'), function ($q) {
                return $q->where('user_id', Auth::id())
                    ->orWhere('complainant_email', Auth::user()->email);
            })
            ->latest();

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

        $complaints = $query->paginate(10)->appends($request->query());

        // Statistics untuk dashboard
        $stats = [
            'total' => Complaint::count(),
            'open' => Complaint::where('status', 'open')->count(),
            'in_progress' => Complaint::where('status', 'in_progress')->count(),
            'resolved' => Complaint::where('status', 'resolved')->count(),
        ];

        return view('complaints.index', compact('complaints', 'stats'));
    }

    public function create()
    {
        return view('complaints.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|in:infrastruktur,pelayanan,lingkungan,keamanan,lainnya',
            'priority' => 'sometimes|in:low,medium,high,urgent',
            'location' => 'nullable|string|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'contact_email' => 'nullable|email|max:255',
            'attachments.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:10240', // 10MB
        ]);
        
        // Map form fields to database fields
        $complaintData = [
            'subject' => $validated['subject'],
            'description' => $validated['description'],
            'category' => $validated['category'],
            'priority' => $validated['priority'] ?? 'medium',
            'complainant_name' => auth()->user()->name,
            'complainant_email' => $validated['contact_email'] ?? auth()->user()->email,
            'complainant_phone' => $validated['contact_phone'],
            'complainant_address' => $validated['location'] ?? 'Tidak disebutkan',
            'user_id' => auth()->id(),
        ];

        // Handle file uploads
        $attachments = [];
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('complaints', 'public');
                $attachments[] = [
                    'name' => $file->getClientOriginalName(),
                    'path' => $path,
                    'size' => $file->getSize(),
                    'type' => $file->getMimeType(),
                ];
            }
        }

        $complaintData['attachments'] = $attachments;
        $complaintData['status'] = 'open';

        $complaint = Complaint::create($complaintData);

        // Fire event for notification
        event(new ComplaintCreated($complaint));

        return redirect()->route('complaints.index')
            ->with('success', 'Pengaduan berhasil diajukan dengan nomor tiket: ' . $complaint->ticket_number);
    }

    public function show(Complaint $complaint)
    {
        // Check authorization
        if (Auth::check() && Auth::user()->hasRole('user')) {
            if ($complaint->user_id !== Auth::id() && $complaint->complainant_email !== Auth::user()->email) {
                abort(403, 'Anda tidak memiliki akses ke pengaduan ini.');
            }
        }

        $complaint->load(['user', 'assignedUser']);
        
        return view('complaints.show', compact('complaint'));
    }

    public function edit(Complaint $complaint)
    {
        // Only allow editing if complaint is still open and user owns it
        if ($complaint->status !== 'open') {
            return redirect()->route('complaints.show', $complaint)
                ->with('error', 'Pengaduan yang sudah diproses tidak dapat diubah.');
        }

        if (Auth::check() && Auth::user()->hasRole('user')) {
            if ($complaint->user_id !== Auth::id() && $complaint->complainant_email !== Auth::user()->email) {
                abort(403, 'Anda tidak memiliki akses untuk mengubah pengaduan ini.');
            }
        }

        return view('complaints.edit', compact('complaint'));
    }

    public function update(Request $request, Complaint $complaint)
    {
        // Only allow updating if complaint is still open
        if ($complaint->status !== 'open') {
            return redirect()->route('complaints.show', $complaint)
                ->with('error', 'Pengaduan yang sudah diproses tidak dapat diubah.');
        }

        $validated = $request->validate([
            'complainant_name' => 'required|string|max:255',
            'complainant_email' => 'nullable|email|max:255',
            'complainant_phone' => 'required|string|max:20',
            'complainant_address' => 'required|string',
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|in:infrastruktur,pelayanan,lingkungan,keamanan,lainnya',
            'attachments.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120',
        ]);

        // Handle new file uploads
        $existingAttachments = $complaint->attachments ?? [];
        $newAttachments = [];
        
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('complaints', 'public');
                $newAttachments[] = [
                    'name' => $file->getClientOriginalName(),
                    'path' => $path,
                    'size' => $file->getSize(),
                    'type' => $file->getMimeType(),
                ];
            }
        }

        $validated['attachments'] = array_merge($existingAttachments, $newAttachments);

        $complaint->update($validated);

        return redirect()->route('complaints.index')
            ->with('success', 'Pengaduan berhasil diperbarui.');
    }

    public function destroy(Complaint $complaint)
    {
        // Only allow deletion if complaint is still open and user owns it
        if ($complaint->status !== 'open') {
            return redirect()->route('complaints.index')
                ->with('error', 'Pengaduan yang sudah diproses tidak dapat dihapus.');
        }

        if (Auth::check() && Auth::user()->hasRole('user')) {
            if ($complaint->user_id !== Auth::id() && $complaint->complainant_email !== Auth::user()->email) {
                abort(403, 'Anda tidak memiliki akses untuk menghapus pengaduan ini.');
            }
        }

        // Delete attachments
        if ($complaint->attachments) {
            foreach ($complaint->attachments as $attachment) {
                Storage::disk('public')->delete($attachment['path']);
            }
        }

        $complaint->delete();

        return redirect()->route('complaints.index')
            ->with('success', 'Pengaduan berhasil dihapus.');
    }

    // Public form untuk pengaduan tanpa login
    public function publicForm()
    {
        return view('complaints.public-form');
    }

    // Public store untuk pengaduan tanpa login
    public function publicStore(Request $request)
    {
        $validated = $request->validate([
            'complainant_name' => 'required|string|max:255',
            'complainant_email' => 'nullable|email|max:255',
            'complainant_phone' => 'required|string|max:20',
            'complainant_address' => 'required|string',
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|in:infrastruktur,pelayanan,lingkungan,keamanan,lainnya',
            'attachments.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120',
        ]);

        // Handle file uploads
        $attachments = [];
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('complaints', 'public');
                $attachments[] = [
                    'name' => $file->getClientOriginalName(),
                    'path' => $path,
                    'size' => $file->getSize(),
                    'type' => $file->getMimeType(),
                ];
            }
        }

        $validated['attachments'] = $attachments;
        $validated['priority'] = 'medium';
        $validated['status'] = 'open';

        $complaint = Complaint::create($validated);

        // Fire event for notification
        event(new ComplaintCreated($complaint));

        return redirect()->route('complaints.track')
            ->with('success', 'Pengaduan berhasil diajukan dengan nomor tiket: ' . $complaint->ticket_number)
            ->with('ticket_number', $complaint->ticket_number);
    }

    // Track pengaduan berdasarkan nomor tiket
    public function track(Request $request)
    {
        $complaint = null;
        
        if ($request->filled('ticket_number')) {
            $complaint = Complaint::with(['assignedUser'])
                ->where('ticket_number', $request->ticket_number)
                ->first();
        }

        return view('complaints.track', compact('complaint'));
    }

    // Remove attachment
    public function removeAttachment(Request $request, Complaint $complaint)
    {
        $attachmentIndex = $request->input('index');
        $attachments = $complaint->attachments ?? [];
        
        if (isset($attachments[$attachmentIndex])) {
            // Delete file from storage
            Storage::disk('public')->delete($attachments[$attachmentIndex]['path']);
            
            // Remove from array
            unset($attachments[$attachmentIndex]);
            $attachments = array_values($attachments); // Re-index array
            
            $complaint->update(['attachments' => $attachments]);
            
            return response()->json(['success' => true]);
        }
        
        return response()->json(['success' => false], 404);
    }

    // Get categories for select options
    public static function getCategories()
    {
        return [
            'infrastruktur' => 'Infrastruktur',
            'pelayanan' => 'Pelayanan Publik',
            'lingkungan' => 'Lingkungan',
            'keamanan' => 'Keamanan',
            'lainnya' => 'Lainnya',
        ];
    }

    // Get priorities for select options
    public static function getPriorities()
    {
        return [
            'low' => 'Rendah',
            'medium' => 'Sedang',
            'high' => 'Tinggi',
            'urgent' => 'Mendesak',
        ];
    }

    // Get statuses for select options
    public static function getStatuses()
    {
        return [
            'open' => 'Terbuka',
            'in_progress' => 'Sedang Diproses',
            'resolved' => 'Selesai',
            'closed' => 'Ditutup',
        ];
    }
}