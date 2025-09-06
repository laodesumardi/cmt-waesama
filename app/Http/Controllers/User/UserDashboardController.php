<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DocumentRequest;
use App\Models\Complaint;
use App\Models\News;
use App\Models\Transparency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UserDashboardController extends Controller
{
    /**
     * Display the user dashboard
     */
    public function index()
    {
        $user = Auth::user();
        
        // Statistics for the user
        $stats = [
            'total_documents' => DocumentRequest::where('user_id', $user->id)->count(),
            'pending_documents' => DocumentRequest::where('user_id', $user->id)
                ->where('status', 'pending')->count(),
            'approved_documents' => DocumentRequest::where('user_id', $user->id)
                ->where('status', 'approved')->count(),
            'completed_documents' => DocumentRequest::where('user_id', $user->id)
                ->where('status', 'completed')->count(),
            'total_complaints' => Complaint::where('user_id', $user->id)->count(),
            'open_complaints' => Complaint::where('user_id', $user->id)
                ->where('status', 'open')->count(),
            'resolved_complaints' => Complaint::where('user_id', $user->id)
                ->where('status', 'resolved')->count(),
        ];
        
        // Recent document requests
        $recentDocuments = DocumentRequest::where('user_id', $user->id)
            ->latest()
            ->limit(5)
            ->get();
            
        // Recent complaints
        $recentComplaints = Complaint::where('user_id', $user->id)
            ->latest()
            ->limit(5)
            ->get();
            
        // Latest news (public)
        $latestNews = News::where('status', 'published')
            ->where('is_featured', true)
            ->latest()
            ->limit(3)
            ->get();
            
        // Recent transparency data
        $recentTransparency = Transparency::where('status', 'published')
            ->latest()
            ->limit(3)
            ->get();
            
        // Quick actions data
        $quickActions = [
            [
                'title' => 'Ajukan Surat Keterangan',
                'description' => 'Buat pengajuan surat keterangan online',
                'icon' => 'document-text',
                'route' => 'documents.create',
                'color' => 'blue'
            ],
            [
                'title' => 'Buat Pengaduan',
                'description' => 'Sampaikan keluhan atau aspirasi',
                'icon' => 'chat-bubble-left-right',
                'route' => 'complaints.create',
                'color' => 'red'
            ],
            [
                'title' => 'Lihat Status Pengajuan',
                'description' => 'Cek status dokumen yang diajukan',
                'icon' => 'clipboard-document-list',
                'route' => 'documents.index',
                'color' => 'green'
            ],
            [
                'title' => 'Informasi Transparansi',
                'description' => 'Lihat data transparansi kecamatan',
                'icon' => 'eye',
                'route' => 'transparency.index',
                'color' => 'purple'
            ]
        ];
        
        // Monthly statistics for chart
        $monthlyStats = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthlyStats[] = [
                'month' => $date->format('M Y'),
                'documents' => DocumentRequest::where('user_id', $user->id)
                    ->whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count(),
                'complaints' => Complaint::where('user_id', $user->id)
                    ->whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count()
            ];
        }
        
        return view('user.dashboard', compact(
            'stats',
            'recentDocuments',
            'recentComplaints',
            'latestNews',
            'recentTransparency',
            'quickActions',
            'monthlyStats'
        ));
    }
    
    /**
     * Get dashboard statistics via AJAX
     */
    public function getStats()
    {
        $user = Auth::user();
        
        $stats = [
            'total_documents' => DocumentRequest::where('user_id', $user->id)->count(),
            'pending_documents' => DocumentRequest::where('user_id', $user->id)
                ->where('status', 'pending')->count(),
            'approved_documents' => DocumentRequest::where('user_id', $user->id)
                ->where('status', 'approved')->count(),
            'completed_documents' => DocumentRequest::where('user_id', $user->id)
                ->where('status', 'completed')->count(),
            'total_complaints' => Complaint::where('user_id', $user->id)->count(),
            'open_complaints' => Complaint::where('user_id', $user->id)
                ->where('status', 'open')->count(),
            'resolved_complaints' => Complaint::where('user_id', $user->id)
                ->where('status', 'resolved')->count(),
        ];
        
        return response()->json($stats);
    }
    
    /**
     * Get recent activities
     */
    public function getRecentActivities()
    {
        $user = Auth::user();
        
        $activities = collect();
        
        // Recent document requests
        $recentDocuments = DocumentRequest::where('user_id', $user->id)
            ->latest()
            ->limit(10)
            ->get()
            ->map(function ($doc) {
                return [
                    'type' => 'document',
                    'title' => 'Pengajuan ' . $doc->document_type_label,
                    'description' => 'Status: ' . ucfirst($doc->status),
                    'date' => $doc->created_at,
                    'status' => $doc->status,
                    'url' => route('documents.show', $doc->id)
                ];
            });
            
        // Recent complaints
        $recentComplaints = Complaint::where('user_id', $user->id)
            ->latest()
            ->limit(10)
            ->get()
            ->map(function ($complaint) {
                return [
                    'type' => 'complaint',
                    'title' => 'Pengaduan: ' . $complaint->subject,
                    'description' => 'Status: ' . ucfirst($complaint->status),
                    'date' => $complaint->created_at,
                    'status' => $complaint->status,
                    'url' => route('complaints.show', $complaint->id)
                ];
            });
            
        $activities = $activities->merge($recentDocuments)
            ->merge($recentComplaints)
            ->sortByDesc('date')
            ->take(15)
            ->values();
            
        return response()->json($activities);
    }
}