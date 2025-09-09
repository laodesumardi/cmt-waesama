<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Events\NewsCreated;
use App\Events\NewsUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = News::with('author');

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan kategori
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        // Filter berdasarkan tanggal
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $news = $query->orderBy('created_at', 'desc')->paginate(10);

        // Statistik
        $stats = [
            'total' => News::count(),
            'published' => News::where('status', 'published')->count(),
            'draft' => News::where('status', 'draft')->count(),
            'featured' => News::where('is_featured', true)->count(),
            'this_month' => News::whereMonth('created_at', now()->month)
                                ->whereYear('created_at', now()->year)
                                ->count(),
        ];

        $categories = News::getCategories();
        $statuses = [
            'draft' => 'Draft',
            'published' => 'Published'
        ];

        return view('admin.news.index', compact('news', 'stats', 'categories', 'statuses'));
    }

    public function create()
    {
        $categories = News::getCategories();
        $statuses = [
            'draft' => 'Draft',
            'published' => 'Published'
        ];
        return view('admin.news.create', compact('categories', 'statuses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'category' => 'required|in:' . implode(',', array_keys(News::getCategories())),
            'action' => 'required|in:draft,publish',
            'is_featured' => 'boolean',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'published_at' => 'nullable|date',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'tags' => 'nullable|string',
        ]);

        // Set status based on action parameter
        $validated['status'] = $validated['action'] === 'publish' ? 'published' : 'draft';
        unset($validated['action']); // Remove action from validated data

        // Generate slug
        $validated['slug'] = Str::slug($validated['title']);
        
        // Pastikan slug unik
        $originalSlug = $validated['slug'];
        $counter = 1;
        while (News::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $originalSlug . '-' . $counter;
            $counter++;
        }

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('news/featured', 'public');
        }

        // Handle gallery images upload
        $galleryImages = [];
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $galleryImages[] = $image->store('news/gallery', 'public');
            }
        }
        $validated['gallery_images'] = $galleryImages;

        // Set author
        $validated['author_id'] = auth()->id();

        // Handle published_at
        if ($validated['status'] === 'published' && !$validated['published_at']) {
            $validated['published_at'] = now();
        }

        // Convert tags to array
        if ($validated['tags']) {
            $validated['tags'] = array_map('trim', explode(',', $validated['tags']));
        }

        $news = News::create($validated);

        // Trigger event
        event(new NewsCreated($news));

        return redirect()->route('admin.news.index')
            ->with('success', 'Berita berhasil dibuat.');
    }

    public function show(News $news)
    {
        $news->load('author');
        
        // Get related news (same category, exclude current news)
        $relatedNews = News::where('category', $news->category)
            ->where('id', '!=', $news->id)
            ->where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        return view('admin.news.show', compact('news', 'relatedNews'));
    }

    public function edit(News $news)
    {
        $categories = News::getCategories();
        $statuses = [
            'draft' => 'Draft',
            'published' => 'Published'
        ];
        return view('admin.news.edit', compact('news', 'categories', 'statuses'));
    }

    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'category' => 'required|in:' . implode(',', array_keys(News::getCategories())),
            'action' => 'required|in:draft,publish',
            'is_featured' => 'boolean',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'published_at' => 'nullable|date',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'tags' => 'nullable|string',
            'remove_featured_image' => 'boolean',
            'remove_gallery_images' => 'array',
        ]);

        // Set status based on action parameter
        $validated['status'] = $validated['action'] === 'publish' ? 'published' : 'draft';
        unset($validated['action']); // Remove action from validated data

        // Update slug jika title berubah
        if ($news->title !== $validated['title']) {
            $validated['slug'] = Str::slug($validated['title']);
            
            // Pastikan slug unik
            $originalSlug = $validated['slug'];
            $counter = 1;
            while (News::where('slug', $validated['slug'])->where('id', '!=', $news->id)->exists()) {
                $validated['slug'] = $originalSlug . '-' . $counter;
                $counter++;
            }
        }

        // Handle remove featured image
        if ($request->boolean('remove_featured_image') && $news->featured_image) {
            Storage::disk('public')->delete($news->featured_image);
            $validated['featured_image'] = null;
        }

        // Handle new featured image upload
        if ($request->hasFile('featured_image')) {
            // Delete old image
            if ($news->featured_image) {
                Storage::disk('public')->delete($news->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('news/featured', 'public');
        }

        // Handle gallery images
        $galleryImages = $news->gallery_images ?? [];
        
        // Remove selected gallery images
        if ($request->filled('remove_gallery_images')) {
            foreach ($request->remove_gallery_images as $imageToRemove) {
                if (($key = array_search($imageToRemove, $galleryImages)) !== false) {
                    Storage::disk('public')->delete($imageToRemove);
                    unset($galleryImages[$key]);
                }
            }
            $galleryImages = array_values($galleryImages); // Re-index array
        }

        // Add new gallery images
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $galleryImages[] = $image->store('news/gallery', 'public');
            }
        }
        $validated['gallery_images'] = $galleryImages;

        // Handle published_at
        if ($validated['status'] === 'published' && !$news->published_at && !$validated['published_at']) {
            $validated['published_at'] = now();
        }

        // Convert tags to array
        if ($validated['tags']) {
            $validated['tags'] = array_map('trim', explode(',', $validated['tags']));
        }

        // Store old status for event
        $oldStatus = $news->status;
        
        $news->update($validated);

        // Trigger event if status changed
        if ($oldStatus !== $validated['status']) {
            event(new NewsUpdated($news, $oldStatus, $validated['status']));
        }

        return redirect()->route('admin.news.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(News $news)
    {
        // Delete associated images
        if ($news->featured_image) {
            Storage::disk('public')->delete($news->featured_image);
        }
        
        if ($news->gallery_images) {
            foreach ($news->gallery_images as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $news->delete();

        return redirect()->route('admin.news.index')
            ->with('success', 'Berita berhasil dihapus.');
    }

    public function bulkUpdate(Request $request)
    {
        $validated = $request->validate([
            'news_ids' => 'required|array',
            'news_ids.*' => 'exists:news,id',
            'action' => 'required|in:publish,draft,feature,unfeature,delete',
        ]);

        $newsIds = $validated['news_ids'];
        $action = $validated['action'];

        switch ($action) {
            case 'publish':
                News::whereIn('id', $newsIds)->update([
                    'status' => 'published',
                    'published_at' => now()
                ]);
                $message = 'Berita berhasil dipublikasikan.';
                break;

            case 'draft':
                News::whereIn('id', $newsIds)->update(['status' => 'draft']);
                $message = 'Berita berhasil dijadikan draft.';
                break;

            case 'feature':
                News::whereIn('id', $newsIds)->update(['is_featured' => true]);
                $message = 'Berita berhasil dijadikan unggulan.';
                break;

            case 'unfeature':
                News::whereIn('id', $newsIds)->update(['is_featured' => false]);
                $message = 'Berita berhasil dihapus dari unggulan.';
                break;

            case 'delete':
                $newsToDelete = News::whereIn('id', $newsIds)->get();
                foreach ($newsToDelete as $news) {
                    // Delete associated images
                    if ($news->featured_image) {
                        Storage::disk('public')->delete($news->featured_image);
                    }
                    if ($news->gallery_images) {
                        foreach ($news->gallery_images as $image) {
                            Storage::disk('public')->delete($image);
                        }
                    }
                }
                News::whereIn('id', $newsIds)->delete();
                $message = 'Berita berhasil dihapus.';
                break;
        }

        return redirect()->route('admin.news.index')
            ->with('success', $message);
    }

    public function export(Request $request)
    {
        $query = News::with('author');

        // Apply same filters as index
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%");
            });
        }
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $news = $query->orderBy('created_at', 'desc')->get();

        $filename = 'news_export_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$filename}",
        ];

        $callback = function() use ($news) {
            $file = fopen('php://output', 'w');
            
            // Add BOM for UTF-8
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // Header
            fputcsv($file, [
                'ID', 'Judul', 'Slug', 'Kategori', 'Status', 'Unggulan', 
                'Penulis', 'Tanggal Dibuat', 'Tanggal Publikasi', 'Views'
            ]);

            // Data
            foreach ($news as $item) {
                fputcsv($file, [
                    $item->id,
                    $item->title,
                    $item->slug,
                    $item->category,
                    $item->status,
                    $item->is_featured ? 'Ya' : 'Tidak',
                    $item->author->name ?? 'N/A',
                    $item->created_at->format('Y-m-d H:i:s'),
                    $item->published_at ? $item->published_at->format('Y-m-d H:i:s') : 'N/A',
                    $item->views
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function duplicate(News $news)
    {
        // Create a duplicate of the news
        $duplicatedNews = $news->replicate();
        
        // Modify some fields for the duplicate
        $duplicatedNews->title = 'Copy of ' . $news->title;
        $duplicatedNews->slug = Str::slug($duplicatedNews->title);
        
        // Ensure unique slug
        $originalSlug = $duplicatedNews->slug;
        $counter = 1;
        while (News::where('slug', $duplicatedNews->slug)->exists()) {
            $duplicatedNews->slug = $originalSlug . '-' . $counter;
            $counter++;
        }
        
        // Set as draft
        $duplicatedNews->status = 'draft';
        $duplicatedNews->is_featured = false;
        $duplicatedNews->published_at = null;
        $duplicatedNews->views = 0;
        $duplicatedNews->author_id = auth()->id();
        
        // Copy featured image if exists
        if ($news->featured_image) {
            $originalPath = $news->featured_image;
            $extension = pathinfo($originalPath, PATHINFO_EXTENSION);
            $newFilename = 'news/' . Str::random(40) . '.' . $extension;
            
            if (Storage::disk('public')->exists($originalPath)) {
                Storage::disk('public')->copy($originalPath, $newFilename);
                $duplicatedNews->featured_image = $newFilename;
            }
        }
        
        // Copy gallery images if exists
        if ($news->gallery_images) {
            $newGalleryImages = [];
            foreach ($news->gallery_images as $imagePath) {
                $extension = pathinfo($imagePath, PATHINFO_EXTENSION);
                $newFilename = 'news/gallery/' . Str::random(40) . '.' . $extension;
                
                if (Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->copy($imagePath, $newFilename);
                    $newGalleryImages[] = $newFilename;
                }
            }
            $duplicatedNews->gallery_images = $newGalleryImages;
        }
        
        $duplicatedNews->save();
        
        return redirect()->route('admin.news.edit', $duplicatedNews)
                        ->with('success', 'Berita berhasil diduplikasi sebagai draft.');
    }
}
