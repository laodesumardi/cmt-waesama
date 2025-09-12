<?php

namespace App\Http\Controllers;

use App\Models\LetterRequest;
use App\Events\LetterRequestCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class LetterRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = LetterRequest::where('user_id', auth()->id())
            ->with(['processor']);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('letter_type', 'like', "%{$search}%")
                  ->orWhere('purpose', 'like', "%{$search}%")
                  ->orWhere('applicant_name', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by letter type
        if ($request->filled('letter_type')) {
            $query->where('letter_type', $request->letter_type);
        }

        $letters = $query->latest()->paginate(10);
        $letters->appends($request->query());

        // Stats
        $stats = [
            'total' => LetterRequest::where('user_id', auth()->id())->count(),
            'pending' => LetterRequest::where('user_id', auth()->id())->where('status', 'pending')->count(),
            'processing' => LetterRequest::where('user_id', auth()->id())->where('status', 'processing')->count(),
            'completed' => LetterRequest::where('user_id', auth()->id())->where('status', 'completed')->count(),
            'rejected' => LetterRequest::where('user_id', auth()->id())->where('status', 'rejected')->count(),
        ];

        $letterTypes = LetterRequest::getLetterTypes();

        return view('letters.index', compact('letters', 'stats', 'letterTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $letterTypes = LetterRequest::LETTER_TYPES;
        return view('letters.create', compact('letterTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'letter_type' => ['required', Rule::in(array_keys(LetterRequest::LETTER_TYPES))],
            'purpose' => 'required|string|max:1000',
            'applicant_name' => 'required|string|max:255',
            'applicant_nik' => 'required|string|size:16|regex:/^[0-9]+$/',
            'applicant_phone' => 'required|string|max:20',
            'applicant_address' => 'required|string|max:500',
            'applicant_birth_place' => 'nullable|string|max:255',
            'applicant_birth_date' => 'nullable|date|before:today',
            'applicant_gender' => 'nullable|in:Laki-laki,Perempuan',
            'applicant_religion' => 'nullable|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'applicant_occupation' => 'nullable|string|max:255',
            'additional_data' => 'nullable|array'
        ]);

        $validated['user_id'] = Auth::id();

        $letterRequest = LetterRequest::create($validated);

        // Trigger event manually
        event(new LetterRequestCreated($letterRequest));

        return redirect()->route('letters.index')
                        ->with('success', 'Pengajuan surat berhasil dikirim. Kami akan memproses dalam 1-3 hari kerja.');
    }

    /**
     * Display the specified resource.
     */
    public function show(LetterRequest $letter)
    {
        // Ensure user can only view their own requests
        if ($letter->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }

        $letter->load(['user', 'processor']);
        return view('letters.show', compact('letter'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LetterRequest $letter)
    {
        // Ensure user can only edit their own pending requests
        if ($letter->user_id !== Auth::id() || $letter->status !== 'pending') {
            abort(403, 'Unauthorized access or request cannot be edited.');
        }

        $letterTypes = LetterRequest::LETTER_TYPES;
        return view('letters.edit', compact('letter', 'letterTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LetterRequest $letter)
    {
        // Ensure user can only update their own pending requests
        if ($letter->user_id !== Auth::id() || $letter->status !== 'pending') {
            abort(403, 'Unauthorized access or request cannot be updated.');
        }

        $validated = $request->validate([
            'letter_type' => ['required', Rule::in(array_keys(LetterRequest::LETTER_TYPES))],
            'purpose' => 'required|string|max:1000',
            'applicant_name' => 'required|string|max:255',
            'applicant_nik' => 'required|string|size:16|regex:/^[0-9]+$/',
            'applicant_phone' => 'required|string|max:20',
            'applicant_address' => 'required|string|max:500',
            'additional_data' => 'nullable|array'
        ]);

        $letter->update($validated);

        return redirect()->route('letters.show', $letter)
                        ->with('success', 'Pengajuan surat berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LetterRequest $letter)
    {
        // Ensure user can only delete their own pending requests
        if ($letter->user_id !== Auth::id() || $letter->status !== 'pending') {
            abort(403, 'Unauthorized access or request cannot be deleted.');
        }

        $letter->delete();

        return redirect()->route('letters.index')
                        ->with('success', 'Pengajuan surat berhasil dihapus.');
    }

    /**
     * Show public form for letter request
     */
    public function publicForm()
    {
        $letterTypes = LetterRequest::LETTER_TYPES;
        return view('letters.public-form', compact('letterTypes'));
    }

    /**
     * Store public letter request
     */
    public function publicStore(Request $request)
    {
        $validated = $request->validate([
            'letter_type' => ['required', Rule::in(array_keys(LetterRequest::LETTER_TYPES))],
            'purpose' => 'required|string|max:1000',
            'applicant_name' => 'required|string|max:255',
            'applicant_nik' => 'required|string|size:16|regex:/^[0-9]+$/',
            'applicant_phone' => 'required|string|max:20',
            'applicant_email' => 'nullable|email|max:255',
            'applicant_address' => 'required|string|max:500',
            'applicant_birth_place' => 'nullable|string|max:255',
            'applicant_birth_date' => 'nullable|date|before:today',
            'applicant_gender' => 'nullable|in:Laki-laki,Perempuan',
            'applicant_religion' => 'nullable|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'applicant_marital_status' => 'nullable|in:Belum Kawin,Kawin,Cerai Hidup,Cerai Mati',
            'applicant_occupation' => 'nullable|string|max:255',
            'applicant_nationality' => 'nullable|in:WNI,WNA',
            'additional_data' => 'nullable|array'
        ]);

        // For public requests, user_id can be null or set to a guest user
        $validated['user_id'] = Auth::id(); // Will be null if not authenticated
        
        // Generate request number
        $validated['request_number'] = 'LTR-' . date('Ymd') . '-' . str_pad(LetterRequest::whereDate('created_at', today())->count() + 1, 4, '0', STR_PAD_LEFT);

        $letterRequest = LetterRequest::create($validated);

        // Trigger event manually
        event(new LetterRequestCreated($letterRequest));

        return redirect()->route('letters.public.form')
                        ->with('success', 'Pengajuan surat berhasil dikirim. Kami akan memproses dalam 1-3 hari kerja.');
    }
}