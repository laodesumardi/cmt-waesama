<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Events\LetterRequestUpdated;
use App\Models\LetterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class LetterManagementController extends Controller
{
    /**
     * Display a listing of letter requests.
     */
    public function index(Request $request)
    {
        $query = LetterRequest::with(['user', 'processor'])
            ->orderBy('created_at', 'desc');

        // Filter by status if provided
        if ($request->filled('status')) {
            $query->byStatus($request->status);
        }

        // Filter by letter type if provided
        if ($request->filled('letter_type')) {
            $query->where('letter_type', $request->letter_type);
        }

        // Search by applicant name or NIK
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('applicant_name', 'like', "%{$search}%")
                    ->orWhere('applicant_nik', 'like', "%{$search}%")
                    ->orWhere('request_number', 'like', "%{$search}%");
            });
        }

        $requests = $query->paginate(15);
        $letterTypes = LetterRequest::LETTER_TYPES;
        $statuses = [
            'pending' => 'Menunggu',
            'processing' => 'Diproses',
            'completed' => 'Selesai',
            'rejected' => 'Ditolak'
        ];

        // Statistics
        $stats = [
            'total' => LetterRequest::count(),
            'pending' => LetterRequest::byStatus('pending')->count(),
            'processing' => LetterRequest::byStatus('processing')->count(),
            'completed' => LetterRequest::byStatus('completed')->count(),
            'rejected' => LetterRequest::byStatus('rejected')->count()
        ];

        // Determine view based on user role
        $view = auth()->user()->hasRole('staff') ? 'staff.letters.index' : 'admin.letters.index';
        
        return view($view, compact('requests', 'letterTypes', 'statuses', 'stats'))->with('letters', $requests);
    }

    /**
     * Display the specified letter request.
     */
    public function show(LetterRequest $letter)
    {
        $letter->load(['user', 'processor']);
        
        // Determine view based on user role
        $view = auth()->user()->hasRole('staff') ? 'staff.letters.show' : 'admin.letters.show';
        
        return view($view, compact('letter'));
    }

    /**
     * Update letter request status.
     */
    public function updateStatus(Request $request, LetterRequest $letter)
    {
        try {
            $validated = $request->validate([
                'status' => ['required', Rule::in([
                    'pending',
                    'processing',
                    'completed',
                    'rejected'
                ])],
                'notes' => 'nullable|string|max:1000',
                'rejection_reason' => 'required_if:status,rejected|nullable|string|max:1000'
            ]);

            $updateData = [
                'status' => $validated['status'],
                'notes' => $validated['notes'] ?? null,
                'processed_by' => Auth::id(),
                'processed_at' => now()
            ];

            if ($validated['status'] === 'completed') {
                $updateData['completed_at'] = now();
            }

            if ($validated['status'] === 'rejected') {
                $updateData['rejection_reason'] = $validated['rejection_reason'];
            }

            // Store old status for event
            $oldStatus = $letter->status;
            
            $letter->update($updateData);

            // Trigger event if status changed
            if ($oldStatus !== $validated['status']) {
                event(new LetterRequestUpdated($letter, $oldStatus));
            }

            return response()->json([
                'success' => true,
                'message' => 'Status surat berhasil diperbarui.',
                'status' => $letter->status,
                'status_label' => $letter->status_label
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Assign letter request to staff.
     */
    public function assign(Request $request, LetterRequest $letter)
    {
        $validated = $request->validate([
            'assigned_to' => 'required|exists:users,id'
        ]);

        $letter->update([
            'processed_by' => $validated['assigned_to'],
            'status' => 'processing'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Surat berhasil ditugaskan.'
        ]);
    }

    /**
     * Export letter requests to CSV.
     */
    public function export(Request $request)
    {
        $query = LetterRequest::with(['user', 'processor'])
            ->orderBy('created_at', 'desc');

        // Apply same filters as index
        if ($request->filled('status')) {
            $query->byStatus($request->status);
        }

        if ($request->filled('letter_type')) {
            $query->where('letter_type', $request->letter_type);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('applicant_name', 'like', "%{$search}%")
                    ->orWhere('applicant_nik', 'like', "%{$search}%")
                    ->orWhere('request_number', 'like', "%{$search}%");
            });
        }

        $requests = $query->get();

        $filename = 'letter_requests_' . date('Y-m-d_H-i-s') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($requests) {
            $file = fopen('php://output', 'w');
            
            // Add BOM for UTF-8
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // CSV headers
            fputcsv($file, [
                'ID',
                'Tanggal Pengajuan',
                'Nomor Pengajuan',
                'Jenis Surat',
                'Nama Pemohon',
                'NIK',
                'Telepon',
                'Email',
                'Alamat',
                'Tujuan',
                'Status',
                'Diproses Oleh',
                'Tanggal Diproses',
                'Tanggal Selesai',
                'Catatan',
                'Alasan Penolakan'
            ]);

            foreach ($requests as $request) {
                fputcsv($file, [
                    $request->id,
                    $request->created_at->format('d/m/Y H:i'),
                    $request->request_number ?? 'LTR-' . str_pad($request->id, 6, '0', STR_PAD_LEFT),
                    $request->letter_type_label,
                    $request->applicant_name,
                    $request->applicant_nik,
                    $request->applicant_phone,
                    $request->applicant_email ?? '-',
                    $request->applicant_address,
                    $request->purpose,
                    $request->status_label,
                    $request->processor?->name ?? '-',
                    $request->processed_at?->format('d/m/Y H:i') ?? '-',
                    $request->completed_at?->format('d/m/Y H:i') ?? '-',
                    $request->notes ?? '-',
                    $request->rejection_reason ?? '-'
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}