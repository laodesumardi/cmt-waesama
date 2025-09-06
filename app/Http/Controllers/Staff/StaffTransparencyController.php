<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Transparency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class StaffTransparencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Transparency::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%")
                  ->orWhere('type', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter by type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by year
        if ($request->filled('year')) {
            $query->whereYear('created_at', $request->year);
        }

        // Sort
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $transparencies = $query->paginate(10)->withQueryString();

        // Statistics
        $stats = [
            'total' => Transparency::count(),
            'published' => Transparency::where('status', 'published')->count(),
            'draft' => Transparency::where('status', 'draft')->count(),
            'featured' => Transparency::where('is_featured', true)->count(),
            'total_views' => Transparency::sum('views'),
            'total_downloads' => Transparency::sum('downloads'),
        ];

        // Get unique values for filters
        $categories = Transparency::distinct('category')->pluck('category')->filter();
        $types = Transparency::distinct('type')->pluck('type')->filter();
        $years = Transparency::selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year')
            ->filter();

        return view('staff.transparency.index', compact(
            'transparencies',
            'stats',
            'categories',
            'types',
            'years'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get unique categories and types for dropdowns
        $categories = Transparency::distinct('category')->pluck('category')->filter();
        $types = Transparency::distinct('type')->pluck('type')->filter();

        return view('staff.transparency.create', compact('categories', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'type' => 'required|string|max:100',
            'description' => 'nullable|string',
            'period_start' => 'nullable|date',
            'period_end' => 'nullable|date|after_or_equal:period_start',
            'amount' => 'nullable|string|max:255',
            'files.*' => 'nullable|file|max:10240', // 10MB max per file
            'data_json' => 'nullable|json',
            'status' => 'required|in:draft,published',
            'is_featured' => 'boolean',
        ]);

        $transparency = new Transparency();
        $transparency->title = $request->title;
        $transparency->slug = Str::slug($request->title);
        $transparency->category = $request->category;
        $transparency->type = $request->type;
        $transparency->description = $request->description;
        $transparency->period_start = $request->period_start;
        $transparency->period_end = $request->period_end;
        $transparency->amount = $request->amount;
        $transparency->data_json = $request->data_json;
        $transparency->status = $request->status;
        $transparency->is_featured = $request->boolean('is_featured');
        $transparency->views = 0;
        $transparency->downloads = 0;

        if ($request->status === 'published') {
            $transparency->published_at = now();
        }

        // Handle file uploads
        if ($request->hasFile('files')) {
            $uploadedFiles = [];
            foreach ($request->file('files') as $file) {
                $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('transparency', $filename, 'public');
                
                $uploadedFiles[] = [
                    'original_name' => $file->getClientOriginalName(),
                    'filename' => $filename,
                    'path' => $path,
                    'size' => $file->getSize(),
                    'mime_type' => $file->getMimeType(),
                ];
            }
            $transparency->files = json_encode($uploadedFiles);
        }

        $transparency->save();

        return redirect()->route('staff.transparency.index')
            ->with('success', 'Data transparansi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transparency $transparency)
    {
        return view('staff.transparency.show', compact('transparency'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transparency $transparency)
    {
        // Get unique categories and types for dropdowns
        $categories = Transparency::distinct('category')->pluck('category')->filter();
        $types = Transparency::distinct('type')->pluck('type')->filter();

        return view('staff.transparency.edit', compact('transparency', 'categories', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transparency $transparency)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'type' => 'required|string|max:100',
            'description' => 'nullable|string',
            'period_start' => 'nullable|date',
            'period_end' => 'nullable|date|after_or_equal:period_start',
            'amount' => 'nullable|string|max:255',
            'files.*' => 'nullable|file|max:10240', // 10MB max per file
            'data_json' => 'nullable|json',
            'status' => 'required|in:draft,published',
            'is_featured' => 'boolean',
            'remove_files' => 'nullable|array',
            'remove_files.*' => 'string',
        ]);

        $transparency->title = $request->title;
        $transparency->slug = Str::slug($request->title);
        $transparency->category = $request->category;
        $transparency->type = $request->type;
        $transparency->description = $request->description;
        $transparency->period_start = $request->period_start;
        $transparency->period_end = $request->period_end;
        $transparency->amount = $request->amount;
        $transparency->data_json = $request->data_json;
        $transparency->status = $request->status;
        $transparency->is_featured = $request->boolean('is_featured');

        // Set published_at if status changed to published
        if ($request->status === 'published' && $transparency->published_at === null) {
            $transparency->published_at = now();
        } elseif ($request->status === 'draft') {
            $transparency->published_at = null;
        }

        // Handle existing files
        $existingFiles = json_decode($transparency->files, true) ?? [];
        
        // Remove files marked for deletion
        if ($request->filled('remove_files')) {
            foreach ($request->remove_files as $fileToRemove) {
                foreach ($existingFiles as $key => $file) {
                    if ($file['filename'] === $fileToRemove) {
                        // Delete physical file
                        Storage::disk('public')->delete($file['path']);
                        // Remove from array
                        unset($existingFiles[$key]);
                        break;
                    }
                }
            }
            $existingFiles = array_values($existingFiles); // Re-index array
        }

        // Handle new file uploads
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('transparency', $filename, 'public');
                
                $existingFiles[] = [
                    'original_name' => $file->getClientOriginalName(),
                    'filename' => $filename,
                    'path' => $path,
                    'size' => $file->getSize(),
                    'mime_type' => $file->getMimeType(),
                ];
            }
        }

        $transparency->files = json_encode($existingFiles);
        $transparency->save();

        return redirect()->route('staff.transparency.index')
            ->with('success', 'Data transparansi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transparency $transparency)
    {
        // Delete associated files
        if ($transparency->files) {
            $files = json_decode($transparency->files, true);
            foreach ($files as $file) {
                Storage::disk('public')->delete($file['path']);
            }
        }

        $transparency->delete();

        return redirect()->route('staff.transparency.index')
            ->with('success', 'Data transparansi berhasil dihapus.');
    }

    /**
     * Handle bulk actions
     */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:delete,publish,draft,feature,unfeature',
            'selected_items' => 'required|array|min:1',
            'selected_items.*' => 'exists:transparencies,id',
        ]);

        $transparencies = Transparency::whereIn('id', $request->selected_items);
        $count = $transparencies->count();

        switch ($request->action) {
            case 'delete':
                // Delete files first
                foreach ($transparencies->get() as $transparency) {
                    if ($transparency->files) {
                        $files = json_decode($transparency->files, true);
                        foreach ($files as $file) {
                            Storage::disk('public')->delete($file['path']);
                        }
                    }
                }
                $transparencies->delete();
                $message = "{$count} data transparansi berhasil dihapus.";
                break;

            case 'publish':
                $transparencies->update([
                    'status' => 'published',
                    'published_at' => now()
                ]);
                $message = "{$count} data transparansi berhasil dipublikasikan.";
                break;

            case 'draft':
                $transparencies->update([
                    'status' => 'draft',
                    'published_at' => null
                ]);
                $message = "{$count} data transparansi berhasil dijadikan draft.";
                break;

            case 'feature':
                $transparencies->update(['is_featured' => true]);
                $message = "{$count} data transparansi berhasil dijadikan unggulan.";
                break;

            case 'unfeature':
                $transparencies->update(['is_featured' => false]);
                $message = "{$count} data transparansi berhasil dihapus dari unggulan.";
                break;
        }

        return redirect()->route('staff.transparency.index')
            ->with('success', $message);
    }

    /**
     * Handle bulk update actions
     */
    public function bulkUpdate(Request $request)
    {
        $request->validate([
            'action' => 'required|in:delete,publish,draft,feature,unfeature',
            'selected_items' => 'required|array|min:1',
            'selected_items.*' => 'exists:transparencies,id',
        ]);

        $transparencies = Transparency::whereIn('id', $request->selected_items);
        $count = $transparencies->count();

        switch ($request->action) {
            case 'delete':
                // Delete files first
                foreach ($transparencies->get() as $transparency) {
                    if ($transparency->files) {
                        $files = json_decode($transparency->files, true);
                        foreach ($files as $file) {
                            Storage::disk('public')->delete($file['path']);
                        }
                    }
                }
                $transparencies->delete();
                $message = "{$count} data transparansi berhasil dihapus.";
                break;

            case 'publish':
                $transparencies->update([
                    'status' => 'published',
                    'published_at' => now()
                ]);
                $message = "{$count} data transparansi berhasil dipublikasikan.";
                break;

            case 'draft':
                $transparencies->update([
                    'status' => 'draft',
                    'published_at' => null
                ]);
                $message = "{$count} data transparansi berhasil dijadikan draft.";
                break;

            case 'feature':
                $transparencies->update(['is_featured' => true]);
                $message = "{$count} data transparansi berhasil dijadikan unggulan.";
                break;

            case 'unfeature':
                $transparencies->update(['is_featured' => false]);
                $message = "{$count} data transparansi berhasil dihapus dari unggulan.";
                break;
        }

        return redirect()->route('staff.transparency.index')
            ->with('success', $message);
    }
}