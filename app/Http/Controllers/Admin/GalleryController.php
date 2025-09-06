<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Events\GalleryCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class GalleryController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth'),
            new Middleware('role:admin,staff,super-admin'),
        ];
    }

    /**
     * Display a listing of the gallery.
     */
    public function index(Request $request)
    {
        $query = Gallery::with('uploader')->latest();

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter by featured
        if ($request->filled('featured')) {
            $query->where('is_featured', $request->boolean('featured'));
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }

        $galleries = $query->paginate(12)->appends($request->query());

        // Statistics
        $stats = [
            'total' => Gallery::count(),
            'featured' => Gallery::where('is_featured', true)->count(),
            'this_month' => Gallery::whereMonth('created_at', now()->month)
                                  ->whereYear('created_at', now()->year)
                                  ->count(),
        ];

        $categories = $this->getCategories();

        return view('admin.gallery.index', compact('galleries', 'stats', 'categories'));
    }

    /**
     * Show the form for creating a new gallery item.
     */
    public function create()
    {
        $categories = $this->getCategories();
        return view('admin.gallery.create', compact('categories'));
    }

    /**
     * Store a newly created gallery item in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|in:' . implode(',', array_keys($this->getCategories())),
            'event_date' => 'nullable|date',
            'location' => 'nullable|string|max:255',
            'is_featured' => 'boolean',
            'images' => 'required|array|min:1',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        // Handle multiple image uploads
        $createdGalleries = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('gallery', 'public');
                $galleryData = [
                    'title' => $validated['title'],
                    'description' => $validated['description'],
                    'image_path' => $path,
                    'category' => $validated['category'],
                    'event_date' => $validated['event_date'],
                    'location' => $validated['location'],
                    'is_featured' => $validated['is_featured'] ?? false,
                    'uploaded_by' => Auth::id(),
                ];
                
                // Create individual gallery item to trigger events
                $gallery = Gallery::create($galleryData);
                $createdGalleries[] = $gallery;
                
                // Trigger event for each gallery created
                event(new GalleryCreated($gallery));
            }
        }

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Galeri berhasil ditambahkan.');
    }

    /**
     * Display the specified gallery item.
     */
    public function show(Gallery $gallery)
    {
        $gallery->load('uploader');
        return view('admin.gallery.show', compact('gallery'));
    }

    /**
     * Show the form for editing the specified gallery item.
     */
    public function edit(Gallery $gallery)
    {
        $categories = $this->getCategories();
        return view('admin.gallery.edit', compact('gallery', 'categories'));
    }

    /**
     * Update the specified gallery item in storage.
     */
    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|in:' . implode(',', array_keys($this->getCategories())),
            'event_date' => 'nullable|date',
            'location' => 'nullable|string|max:255',
            'is_featured' => 'boolean',
            'new_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        // Handle new image upload
        if ($request->hasFile('new_image')) {
            // Delete old image
            if ($gallery->image_path) {
                Storage::disk('public')->delete($gallery->image_path);
            }
            $validated['image_path'] = $request->file('new_image')->store('gallery', 'public');
        }

        $gallery->update($validated);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Galeri berhasil diperbarui.');
    }

    /**
     * Remove the specified gallery item from storage.
     */
    public function destroy(Gallery $gallery)
    {
        // Delete image file
        if ($gallery->image_path) {
            Storage::disk('public')->delete($gallery->image_path);
        }

        $gallery->delete();

        return response()->json([
            'success' => true,
            'message' => 'Galeri berhasil dihapus.'
        ]);
    }

    /**
     * Bulk delete gallery items.
     */
    public function bulkDelete(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:galleries,id',
        ]);

        $galleries = Gallery::whereIn('id', $validated['ids'])->get();

        foreach ($galleries as $gallery) {
            // Delete image file
            if ($gallery->image_path) {
                Storage::disk('public')->delete($gallery->image_path);
            }
            $gallery->delete();
        }

        return response()->json([
            'success' => true,
            'message' => count($validated['ids']) . ' galeri berhasil dihapus.'
        ]);
    }

    /**
     * Toggle featured status.
     */
    public function toggleFeatured(Gallery $gallery)
    {
        $gallery->update([
            'is_featured' => !$gallery->is_featured
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Status featured berhasil diubah.',
            'is_featured' => $gallery->is_featured
        ]);
    }

    /**
     * Get available categories.
     */
    /**
     * Export galleries to CSV
     */
    public function export(Request $request)
    {
        $query = Gallery::with('uploader')->latest();

        // Apply same filters as index
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('featured')) {
            $query->where('is_featured', $request->boolean('featured'));
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }

        $galleries = $query->get();
        $categories = $this->getCategories();

        $filename = 'galeri_' . now()->format('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($galleries, $categories) {
            $file = fopen('php://output', 'w');
            
            // Add BOM for UTF-8
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // CSV Headers
            fputcsv($file, [
                'ID',
                'Judul',
                'Deskripsi',
                'Kategori',
                'Lokasi',
                'Tanggal Event',
                'Status Featured',
                'Views',
                'Penulis',
                'Tanggal Dibuat',
                'Tanggal Diupdate'
            ]);

            // CSV Data
            foreach ($galleries as $gallery) {
                fputcsv($file, [
                    $gallery->id,
                    $gallery->title,
                    $gallery->description,
                    $categories[$gallery->category] ?? $gallery->category,
                    $gallery->location,
                    $gallery->event_date ? $gallery->event_date->format('d/m/Y') : '',
                    $gallery->is_featured ? 'Ya' : 'Tidak',
                    $gallery->views ?? 0,
                    $gallery->uploader->name ?? 'Admin',
                    $gallery->created_at->format('d/m/Y H:i'),
                    $gallery->updated_at->format('d/m/Y H:i')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function getCategories()
    {
        return [
            'kegiatan' => 'Kegiatan',
            'acara' => 'Acara',
            'infrastruktur' => 'Infrastruktur',
            'lingkungan' => 'Lingkungan',
            'masyarakat' => 'Masyarakat',
            'pemerintahan' => 'Pemerintahan',
            'lainnya' => 'Lainnya',
        ];
    }
}