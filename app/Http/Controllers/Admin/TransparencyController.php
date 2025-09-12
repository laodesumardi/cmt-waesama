<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transparency;
use App\Events\TransparencyCreated;
use App\Events\TransparencyUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TransparencyController extends Controller
{
    public function index(Request $request)
    {
        $query = Transparency::with(['creator', 'updater'])
            ->orderBy('created_at', 'desc');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
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
            $query->whereYear('period_start', $request->year)
                  ->orWhereYear('period_end', $request->year);
        }

        $transparencies = $query->paginate(15);

        // Statistics
        $stats = [
            'total' => Transparency::count(),
            'published' => Transparency::where('status', 'published')->count(),
            'draft' => Transparency::where('status', 'draft')->count(),
            'featured' => Transparency::where('is_featured', true)->count(),
            'total_views' => Transparency::sum('views'),
            'total_downloads' => Transparency::sum('downloads'),
        ];

        $categories = Transparency::getCategories();
        $types = Transparency::getTypes();

        return view('admin.transparency.index', compact(
            'transparencies', 'stats', 'categories', 'types'
        ));
    }

    public function create()
    {
        $categories = Transparency::getCategories();
        $types = Transparency::getTypes();
        
        return view('admin.transparency.create', compact('categories', 'types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|in:budget,procurement,project,regulation,report,other',
            'type' => 'required|in:document,data,announcement',
            'period_start' => 'nullable|date',
            'period_end' => 'nullable|date|after_or_equal:period_start',
            'amount' => 'nullable|numeric|min:0',
            'status' => 'required|in:draft,published',
            'is_featured' => 'boolean',
            'files.*' => 'nullable|file|max:10240', // 10MB max per file
            'data' => 'nullable|json',
        ]);

        $transparency = new Transparency();
        $transparency->fill($request->except(['files', 'data']));
        $transparency->created_by = Auth::id();
        $transparency->updated_by = Auth::id();
        $transparency->uploaded_by = Auth::id();
        
        if ($request->status === 'published') {
            $transparency->published_at = now();
        }

        // Handle data JSON
        if ($request->filled('data')) {
            $transparency->data = $request->data;
        }

        $transparency->save();

        // Trigger event
        event(new TransparencyCreated($transparency));

        // Handle file uploads
        if ($request->hasFile('files')) {
            $files = [];
            foreach ($request->file('files') as $file) {
                $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('transparency', $filename, 'public');
                
                $files[] = [
                    'name' => $file->getClientOriginalName(),
                    'path' => $path,
                    'url' => Storage::url($path),
                    'size' => $file->getSize(),
                    'type' => $file->getMimeType(),
                ];
            }
            $transparency->files = json_encode($files);
            $transparency->save();
        }

        return redirect()->route('admin.transparency.index')
            ->with('success', 'Data transparansi berhasil ditambahkan.');
    }

    public function show(Transparency $transparency)
    {
        $transparency->load(['creator', 'updater']);
        
        return view('admin.transparency.show', compact('transparency'));
    }

    public function edit(Transparency $transparency)
    {
        $categories = Transparency::getCategories();
        $types = Transparency::getTypes();
        
        return view('admin.transparency.edit', compact('transparency', 'categories', 'types'));
    }

    public function update(Request $request, Transparency $transparency)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|in:budget,procurement,project,regulation,report,other',
            'type' => 'required|in:document,data,announcement',
            'period_start' => 'nullable|date',
            'period_end' => 'nullable|date|after_or_equal:period_start',
            'amount' => 'nullable|numeric|min:0',
            'status' => 'required|in:draft,published',
            'is_featured' => 'boolean',
            'files.*' => 'nullable|file|max:10240',
            'data' => 'nullable|json',
            'remove_files' => 'nullable|array',
        ]);

        $transparency->fill($request->except(['files', 'data', 'remove_files']));
        $transparency->updated_by = Auth::id();
        
        if ($request->status === 'published' && !$transparency->published_at) {
            $transparency->published_at = now();
        } elseif ($request->status === 'draft') {
            $transparency->published_at = null;
        }

        // Handle data JSON
        if ($request->filled('data')) {
            $transparency->data = $request->data;
        }

        // Handle file removal
        if ($request->filled('remove_files')) {
            $currentFiles = json_decode($transparency->files, true) ?? [];
            $filesToRemove = $request->remove_files;
            
            foreach ($filesToRemove as $fileIndex) {
                if (isset($currentFiles[$fileIndex])) {
                    // Delete file from storage
                    Storage::disk('public')->delete($currentFiles[$fileIndex]['path']);
                    unset($currentFiles[$fileIndex]);
                }
            }
            
            $transparency->files = json_encode(array_values($currentFiles));
        }

        // Handle new file uploads
        if ($request->hasFile('files')) {
            $currentFiles = json_decode($transparency->files, true) ?? [];
            
            foreach ($request->file('files') as $file) {
                $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('transparency', $filename, 'public');
                
                $currentFiles[] = [
                    'name' => $file->getClientOriginalName(),
                    'path' => $path,
                    'url' => Storage::url($path),
                    'size' => $file->getSize(),
                    'type' => $file->getMimeType(),
                ];
            }
            
            $transparency->files = json_encode($currentFiles);
        }

        // Store old status for comparison
        $oldStatus = $transparency->getOriginal('status');
        
        $transparency->save();

        // Trigger event if status changed
        if ($oldStatus !== $transparency->status) {
            event(new TransparencyUpdated($transparency, $oldStatus));
        }

        return redirect()->route('admin.transparency.index')
            ->with('success', 'Data transparansi berhasil diperbarui.');
    }

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

        return redirect()->route('admin.transparency.index')
            ->with('success', 'Data transparansi berhasil dihapus.');
    }

    public function bulkUpdate(Request $request)
    {
        $request->validate([
            'action' => 'required|in:publish,unpublish,feature,unfeature,delete',
            'selected_items' => 'required|array|min:1',
            'selected_items.*' => 'exists:transparencies,id',
        ]);

        $transparencies = Transparency::whereIn('id', $request->selected_items);

        switch ($request->action) {
            case 'publish':
                $transparencies->update([
                    'status' => 'published',
                    'published_at' => now(),
                    'updated_by' => Auth::id(),
                ]);
                $message = 'Data transparansi berhasil dipublikasikan.';
                break;

            case 'unpublish':
                $transparencies->update([
                    'status' => 'draft',
                    'published_at' => null,
                    'updated_by' => Auth::id(),
                ]);
                $message = 'Data transparansi berhasil dijadikan draft.';
                break;

            case 'feature':
                $transparencies->update([
                    'is_featured' => true,
                    'updated_by' => Auth::id(),
                ]);
                $message = 'Data transparansi berhasil dijadikan unggulan.';
                break;

            case 'unfeature':
                $transparencies->update([
                    'is_featured' => false,
                    'updated_by' => Auth::id(),
                ]);
                $message = 'Data transparansi berhasil dihapus dari unggulan.';
                break;

            case 'delete':
                // Delete files for each transparency
                foreach ($transparencies->get() as $transparency) {
                    if ($transparency->files) {
                        $files = json_decode($transparency->files, true);
                        foreach ($files as $file) {
                            Storage::disk('public')->delete($file['path']);
                        }
                    }
                }
                $transparencies->delete();
                $message = 'Data transparansi berhasil dihapus.';
                break;
        }

        return redirect()->route('admin.transparency.index')
            ->with('success', $message);
    }

    public function export(Request $request)
    {
        $query = Transparency::with(['creator', 'updater']);

        // Apply same filters as index
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $transparencies = $query->get();

        $filename = 'transparansi_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$filename}",
        ];

        $callback = function() use ($transparencies) {
            $file = fopen('php://output', 'w');
            
            // Add BOM for UTF-8
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // CSV headers
            fputcsv($file, [
                'ID', 'Judul', 'Kategori', 'Tipe', 'Periode Mulai', 'Periode Selesai',
                'Jumlah', 'Status', 'Unggulan', 'Views', 'Downloads', 'Dibuat Oleh',
                'Tanggal Dibuat', 'Dipublikasikan'
            ]);

            foreach ($transparencies as $transparency) {
                fputcsv($file, [
                    $transparency->id,
                    $transparency->title,
                    $transparency->category_display,
                    $transparency->type_display,
                    $transparency->period_start?->format('Y-m-d'),
                    $transparency->period_end?->format('Y-m-d'),
                    $transparency->amount,
                    $transparency->status,
                    $transparency->is_featured ? 'Ya' : 'Tidak',
                    $transparency->views,
                    $transparency->downloads,
                    $transparency->creator?->name,
                    $transparency->created_at->format('Y-m-d H:i:s'),
                    $transparency->published_at?->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
