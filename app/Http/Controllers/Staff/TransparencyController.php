<?php

namespace App\Http\Controllers\Staff;

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

        return view('staff.transparency.index', compact(
            'transparencies', 'stats', 'categories', 'types'
        ));
    }

    public function create()
    {
        $categories = Transparency::getCategories();
        $types = Transparency::getTypes();
        
        return view('staff.transparency.create', compact('categories', 'types'));
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
        
        if ($request->status === 'published') {
            $transparency->published_at = now();
        }

        // Handle JSON data
        if ($request->filled('data')) {
            $transparency->data = json_decode($request->data, true);
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

        return redirect()->route('staff.transparency.index')
            ->with('success', 'Data transparansi berhasil ditambahkan.');
    }

    public function show(Transparency $transparency)
    {
        $transparency->load(['creator', 'updater']);
        
        return view('staff.transparency.show', compact('transparency'));
    }

    public function edit(Transparency $transparency)
    {
        $categories = Transparency::getCategories();
        $types = Transparency::getTypes();
        
        return view('staff.transparency.edit', compact('transparency', 'categories', 'types'));
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
        ]);

        // Store old status for comparison
        $oldStatus = $transparency->getOriginal('status');
        
        $transparency->fill($request->except(['files', 'data']));
        $transparency->updated_by = Auth::id();
        
        if ($request->status === 'published' && !$transparency->published_at) {
            $transparency->published_at = now();
        }

        // Handle JSON data
        if ($request->filled('data')) {
            $transparency->data = json_decode($request->data, true);
        }

        $transparency->save();

        // Trigger event if status changed
        if ($oldStatus !== $transparency->status) {
            event(new TransparencyUpdated($transparency, $oldStatus));
        }

        // Handle file uploads
        if ($request->hasFile('files')) {
            // Delete old files
            if ($transparency->files) {
                $oldFiles = json_decode($transparency->files, true);
                foreach ($oldFiles as $file) {
                    Storage::disk('public')->delete($file['path']);
                }
            }

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

        return redirect()->route('staff.transparency.index')
            ->with('success', 'Data transparansi berhasil diperbarui.');
    }

    public function destroy(Transparency $transparency)
    {
        // Delete files
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

    public function bulkUpdate(Request $request)
    {
        $request->validate([
            'action' => 'required|in:publish,unpublish,feature,unfeature,delete',
            'ids' => 'required|array',
            'ids.*' => 'exists:transparency,id',
        ]);

        $transparencies = Transparency::whereIn('id', $request->ids);
        $message = '';

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

        return redirect()->route('staff.transparency.index')
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

        if ($request->filled('year')) {
            $query->whereYear('period_start', $request->year)
                  ->orWhereYear('period_end', $request->year);
        }

        $transparencies = $query->orderBy('created_at', 'desc')->get();

        $filename = 'transparansi_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($transparencies) {
            $file = fopen('php://output', 'w');
            
            // Add BOM for UTF-8
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // Header
            fputcsv($file, [
                'ID',
                'Judul',
                'Deskripsi',
                'Kategori',
                'Tipe',
                'Periode Mulai',
                'Periode Selesai',
                'Jumlah',
                'Status',
                'Unggulan',
                'Views',
                'Downloads',
                'Dibuat Oleh',
                'Tanggal Dibuat',
                'Diperbarui Oleh',
                'Tanggal Diperbarui'
            ]);
            
            // Data
            foreach ($transparencies as $transparency) {
                fputcsv($file, [
                    $transparency->id,
                    $transparency->title,
                    $transparency->description,
                    $transparency->category_display,
                    $transparency->type_display,
                    $transparency->period_start ? $transparency->period_start->format('d/m/Y') : '',
                    $transparency->period_end ? $transparency->period_end->format('d/m/Y') : '',
                    $transparency->formatted_amount,
                    $transparency->status,
                    $transparency->is_featured ? 'Ya' : 'Tidak',
                    $transparency->views,
                    $transparency->downloads,
                    $transparency->creator ? $transparency->creator->name : '',
                    $transparency->created_at->format('d/m/Y H:i'),
                    $transparency->updater ? $transparency->updater->name : '',
                    $transparency->updated_at->format('d/m/Y H:i')
                ]);
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}