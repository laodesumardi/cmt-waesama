<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DocumentRequest;
use App\Models\User;
use App\Events\DocumentRequestUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class DocumentManagementController extends Controller
{
    /**
     * Display a listing of document requests.
     */
    public function index(Request $request)
    {
        $query = DocumentRequest::with(['user', 'processor'])
            ->orderBy('created_at', 'desc');

        // Filter by status if provided
        if ($request->filled('status')) {
            $query->byStatus($request->status);
        }

        // Filter by document type if provided
        if ($request->filled('document_type')) {
            $query->byDocumentType($request->document_type);
        }

        // Search by applicant name or NIK
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('applicant_name', 'like', "%{$search}%")
                    ->orWhere('applicant_nik', 'like', "%{$search}%");
            });
        }

        $requests = $query->paginate(15);
        $documentTypes = DocumentRequest::DOCUMENT_TYPES;
        $statuses = [
            DocumentRequest::STATUS_PENDING => 'Menunggu',
            DocumentRequest::STATUS_PROCESSING => 'Diproses',
            DocumentRequest::STATUS_COMPLETED => 'Selesai',
            DocumentRequest::STATUS_REJECTED => 'Ditolak'
        ];

        // Statistics
        $stats = [
            'total' => DocumentRequest::count(),
            'pending' => DocumentRequest::byStatus(DocumentRequest::STATUS_PENDING)->count(),
            'processing' => DocumentRequest::byStatus(DocumentRequest::STATUS_PROCESSING)->count(),
            'completed' => DocumentRequest::byStatus(DocumentRequest::STATUS_COMPLETED)->count(),
            'rejected' => DocumentRequest::byStatus(DocumentRequest::STATUS_REJECTED)->count()
        ];

        // Determine view based on user role
        $view = auth()->user()->hasRole('staff') ? 'staff.documents.index' : 'admin.documents.index';
        
        return view($view, compact('requests', 'documentTypes', 'statuses', 'stats'))->with('documents', $requests);
    }

    /**
     * Display the specified document request.
     */
    public function show(DocumentRequest $document)
    {
        $document->load(['user', 'processor']);
        
        // Determine view based on user role
        $view = auth()->user()->hasRole('staff') ? 'staff.documents.show' : 'admin.documents.show';
        
        return view($view, compact('document'));
    }

    /**
     * Update document request status.
     */
    public function updateStatus(Request $request, DocumentRequest $document)
    {
        try {
            $validated = $request->validate([
                'status' => ['required', Rule::in([
                    DocumentRequest::STATUS_PENDING,
                    DocumentRequest::STATUS_PROCESSING,
                    DocumentRequest::STATUS_COMPLETED,
                    DocumentRequest::STATUS_REJECTED
                ])],
                'notes' => 'nullable|string|max:1000',
                'rejection_reason' => 'required_if:status,' . DocumentRequest::STATUS_REJECTED . '|nullable|string|max:1000'
            ]);

            $updateData = [
                'status' => $validated['status'],
                'notes' => $validated['notes'] ?? null,
                'processed_by' => Auth::id(),
                'processed_at' => now()
            ];

            if ($validated['status'] === DocumentRequest::STATUS_COMPLETED) {
                $updateData['completed_at'] = now();
            }

            if ($validated['status'] === DocumentRequest::STATUS_REJECTED) {
                $updateData['rejection_reason'] = $validated['rejection_reason'];
            }

            // Store old status for event
            $oldStatus = $document->status;
            
            $document->update($updateData);

            // Trigger event if status changed
            if ($oldStatus !== $validated['status']) {
                event(new DocumentRequestUpdated($document, $oldStatus, $validated['status']));
            }

            $statusLabel = match ($validated['status']) {
                DocumentRequest::STATUS_PENDING => 'menunggu',
                DocumentRequest::STATUS_PROCESSING => 'diproses',
                DocumentRequest::STATUS_COMPLETED => 'selesai',
                DocumentRequest::STATUS_REJECTED => 'ditolak',
            };

            // Check if request expects JSON (AJAX request)
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => "Status pengajuan berhasil diubah menjadi {$statusLabel}.",
                    'status' => $validated['status'],
                    'status_label' => $statusLabel
                ]);
            }

            return redirect()->route('admin.documents.show', $document)
                ->with('success', "Status pengajuan berhasil diubah menjadi {$statusLabel}.");
                
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak valid.',
                    'errors' => $e->errors()
                ], 422);
            }
            throw $e;
        } catch (\Exception $e) {
            \Log::error('Error updating document status: ' . $e->getMessage(), [
                'document_id' => $document->id,
                'user_id' => Auth::id(),
                'request_data' => $request->all()
            ]);
            
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat memproses permintaan. Silakan coba lagi.'
                ], 500);
            }
            
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memproses permintaan.');
        }
    }

    /**
     * Bulk update document requests.
     */
    public function bulkUpdate(Request $request)
    {
        $validated = $request->validate([
            'document_ids' => 'required|array|min:1',
            'document_ids.*' => 'exists:document_requests,id',
            'action' => ['required', Rule::in(['approve', 'reject', 'process'])],
            'notes' => 'nullable|string|max:1000',
            'rejection_reason' => 'required_if:action,reject|nullable|string|max:1000'
        ]);

        $status = match ($validated['action']) {
            'approve' => DocumentRequest::STATUS_COMPLETED,
            'reject' => DocumentRequest::STATUS_REJECTED,
            'process' => DocumentRequest::STATUS_PROCESSING,
        };

        $updateData = [
            'status' => $status,
            'notes' => $validated['notes'] ?? null,
            'processed_by' => Auth::id(),
            'processed_at' => now()
        ];

        if ($status === DocumentRequest::STATUS_COMPLETED) {
            $updateData['completed_at'] = now();
        }

        if ($status === DocumentRequest::STATUS_REJECTED) {
            $updateData['rejection_reason'] = $validated['rejection_reason'];
        }

        DocumentRequest::whereIn('id', $validated['document_ids'])
            ->update($updateData);

        $count = count($validated['document_ids']);
        $actionLabel = match ($validated['action']) {
            'approve' => 'disetujui',
            'reject' => 'ditolak',
            'process' => 'diproses',
        };

        // Check if request expects JSON (AJAX request)
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => "{$count} pengajuan berhasil {$actionLabel}.",
                'count' => $count,
                'action' => $validated['action']
            ]);
        }

        return redirect()->route('admin.documents.index')
            ->with('success', "{$count} pengajuan berhasil {$actionLabel}.");
    }

    /**
     * Export document requests to CSV.
     */
    public function export(Request $request)
    {
        $query = DocumentRequest::with(['user', 'processor']);

        // Apply same filters as index
        if ($request->filled('status')) {
            $query->byStatus($request->status);
        }

        if ($request->filled('document_type')) {
            $query->byDocumentType($request->document_type);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('applicant_name', 'like', "%{$search}%")
                    ->orWhere('applicant_nik', 'like', "%{$search}%");
            });
        }

        $requests = $query->orderBy('created_at', 'desc')->get();

        $filename = 'document_requests_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$filename}",
        ];

        $callback = function () use ($requests) {
            $file = fopen('php://output', 'w');

            // Add BOM for UTF-8
            fwrite($file, "\xEF\xBB\xBF");

            // CSV headers
            fputcsv($file, [
                'ID',
                'Tanggal Pengajuan',
                'Jenis Dokumen',
                'Nama Pemohon',
                'NIK',
                'Telepon',
                'Alamat',
                'Keperluan',
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
                    $request->document_type_label,
                    $request->applicant_name,
                    $request->applicant_nik,
                    $request->applicant_phone,
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
