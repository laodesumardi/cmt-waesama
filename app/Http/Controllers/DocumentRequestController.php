<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DocumentRequest;
use App\Events\DocumentRequestCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class DocumentRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = DocumentRequest::where('user_id', auth()->id())
            ->with(['processor']);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('request_number', 'like', "%{$search}%")
                  ->orWhere('document_type', 'like', "%{$search}%")
                  ->orWhere('purpose', 'like', "%{$search}%")
                  ->orWhere('applicant_name', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by document type
        if ($request->filled('document_type')) {
            $query->where('document_type', $request->document_type);
        }

        $documents = $query->latest()->paginate(10);
        $documents->appends($request->query());

        // Stats
        $stats = [
            'total' => DocumentRequest::where('user_id', auth()->id())->count(),
            'pending' => DocumentRequest::where('user_id', auth()->id())->where('status', 'pending')->count(),
            'processing' => DocumentRequest::where('user_id', auth()->id())->where('status', 'processing')->count(),
            'completed' => DocumentRequest::where('user_id', auth()->id())->where('status', 'completed')->count(),
            'rejected' => DocumentRequest::where('user_id', auth()->id())->where('status', 'rejected')->count(),
        ];

        $documentTypes = DocumentRequest::getDocumentTypes();

        return view('documents.index', compact('documents', 'stats', 'documentTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $documentTypes = DocumentRequest::DOCUMENT_TYPES;
        return view('documents.create', compact('documentTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'document_type' => ['required', Rule::in(array_keys(DocumentRequest::DOCUMENT_TYPES))],
            'purpose' => 'required|string|max:1000',
            'applicant_name' => 'required|string|max:255',
            'applicant_nik' => 'required|string|size:16|regex:/^[0-9]+$/',
            'applicant_phone' => 'required|string|max:20',
            'applicant_email' => 'nullable|email|max:255',
            'applicant_address' => 'required|string|max:500',
            'applicant_birth_place' => 'required|string|max:255',
            'applicant_birth_date' => 'required|date|before:today',
            'applicant_gender' => 'required|in:Laki-laki,Perempuan',
            'applicant_religion' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'applicant_marital_status' => 'required|in:Belum Kawin,Kawin,Cerai Hidup,Cerai Mati',
            'applicant_occupation' => 'required|string|max:255',
            'applicant_nationality' => 'required|in:WNI,WNA',
            'additional_data' => 'nullable|array'
        ]);

        $validated['user_id'] = Auth::id();
        
        // Use database transaction to ensure unique request number
        $documentRequest = DB::transaction(function () use ($validated) {
            // Generate unique request number
            $today = date('Ymd');
            $prefix = 'DOC-' . $today . '-';
            
            // Find the highest existing number for today with row lock
            $lastRequest = DocumentRequest::where('request_number', 'like', $prefix . '%')
                ->orderBy('request_number', 'desc')
                ->lockForUpdate()
                ->first();
                
            if ($lastRequest) {
                // Extract the number part and increment
                $lastNumber = (int) substr($lastRequest->request_number, -4);
                $nextNumber = $lastNumber + 1;
            } else {
                // First request of the day
                $nextNumber = 1;
            }
            
            $validated['request_number'] = $prefix . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

            return DocumentRequest::create($validated);
        });

        // Trigger event
        event(new DocumentRequestCreated($documentRequest));

        return redirect()->route('documents.index')
                        ->with('success', 'Pengajuan dokumen berhasil dikirim. Kami akan memproses dalam 1-3 hari kerja.');
    }

    /**
     * Display the specified resource.
     */
    public function show(DocumentRequest $document)
    {
        // Ensure user can only view their own requests
        if ($document->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }

        $document->load(['user', 'processor']);
        return view('documents.show', compact('document'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DocumentRequest $document)
    {
        // Ensure user can only edit their own pending requests
        if ($document->user_id !== Auth::id() || $document->status !== DocumentRequest::STATUS_PENDING) {
            abort(403, 'Unauthorized access or request cannot be edited.');
        }

        $documentTypes = DocumentRequest::DOCUMENT_TYPES;
        return view('documents.edit', compact('document', 'documentTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DocumentRequest $document)
    {
        // Ensure user can only update their own pending requests
        if ($document->user_id !== Auth::id() || $document->status !== DocumentRequest::STATUS_PENDING) {
            abort(403, 'Unauthorized access or request cannot be updated.');
        }

        $validated = $request->validate([
            'document_type' => ['required', Rule::in(array_keys(DocumentRequest::DOCUMENT_TYPES))],
            'purpose' => 'required|string|max:1000',
            'applicant_name' => 'required|string|max:255',
            'applicant_nik' => 'required|string|size:16|regex:/^[0-9]+$/',
            'applicant_phone' => 'required|string|max:20',
            'applicant_address' => 'required|string|max:500',
            'additional_data' => 'nullable|array'
        ]);

        $document->update($validated);

        return redirect()->route('documents.show', $document)
                        ->with('success', 'Pengajuan dokumen berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DocumentRequest $document)
    {
        // Ensure user can only delete their own pending requests
        if ($document->user_id !== Auth::id() || $document->status !== DocumentRequest::STATUS_PENDING) {
            abort(403, 'Unauthorized access or request cannot be deleted.');
        }

        $document->delete();

        return redirect()->route('documents.index')
                        ->with('success', 'Pengajuan dokumen berhasil dibatalkan.');
    }

    /**
     * Show document request form for public access
     */
    public function publicForm()
    {
        $documentTypes = DocumentRequest::getDocumentTypes();
        return view('documents.public-form', compact('documentTypes'));
    }

    /**
     * Track document request status
     */
    public function track(Request $request)
    {
        $documents = null;
        
        if ($request->filled('request_number') || $request->filled('nik')) {
            $query = DocumentRequest::with(['processor']);
            
            if ($request->filled('request_number')) {
                $query->where('request_number', $request->request_number);
            }
            
            if ($request->filled('nik')) {
                $query->where('applicant_nik', $request->nik);
            }
            
            $documents = $query->get();
        }
        
        return view('documents.track', compact('documents'));
    }

    /**
     * Show status page for user's document requests
     */
    public function status(Request $request)
    {
        $query = DocumentRequest::where('user_id', auth()->id())
            ->with(['processor'])
            ->orderBy('created_at', 'desc');

        // Filter by status if provided
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $documents = $query->paginate(10);
        $documents->appends($request->query());

        // Stats for status overview
        $stats = [
            'total' => DocumentRequest::where('user_id', auth()->id())->count(),
            'pending' => DocumentRequest::where('user_id', auth()->id())->where('status', 'pending')->count(),
            'processing' => DocumentRequest::where('user_id', auth()->id())->where('status', 'processing')->count(),
            'completed' => DocumentRequest::where('user_id', auth()->id())->where('status', 'completed')->count(),
            'rejected' => DocumentRequest::where('user_id', auth()->id())->where('status', 'rejected')->count(),
        ];

        return view('documents.status', compact('documents', 'stats'));
    }

    /**
     * Store public document request
     */
    public function publicStore(Request $request)
    {
        $validated = $request->validate([
            'document_type' => ['required', Rule::in(array_keys(DocumentRequest::DOCUMENT_TYPES))],
            'purpose' => 'required|string|max:1000',
            'applicant_name' => 'required|string|max:255',
            'applicant_nik' => 'required|string|size:16|regex:/^[0-9]+$/',
            'applicant_phone' => 'required|string|max:20',
            'applicant_address' => 'required|string|max:500',
            'applicant_birth_place' => 'required|string|max:255',
            'applicant_birth_date' => 'required|date|before:today',
            'applicant_gender' => 'required|in:Laki-laki,Perempuan',
            'applicant_religion' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'applicant_occupation' => 'required|string|max:255',
            'additional_data' => 'nullable|array'
        ]);

        // For public requests, user_id can be null or set to a guest user
        $validated['user_id'] = Auth::id(); // Will be null if not authenticated

        $documentRequest = DocumentRequest::create($validated);

        // Trigger event
        event(new DocumentRequestCreated($documentRequest));

        return redirect()->route('services.documents')
                        ->with('success', 'Pengajuan dokumen berhasil dikirim. Kami akan memproses dalam 1-3 hari kerja.');
    }
}