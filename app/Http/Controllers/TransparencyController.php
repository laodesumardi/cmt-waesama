<?php

namespace App\Http\Controllers;

use App\Models\Transparency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TransparencyController extends Controller
{
    /**
     * Display transparency portal homepage
     */
    public function index(Request $request)
    {
        $query = Transparency::published()->with(['creator']);
        
        // Filter by category
        if ($request->filled('category')) {
            $query->byCategory($request->category);
        }
        
        // Filter by type
        if ($request->filled('type')) {
            $query->byType($request->type);
        }
        
        // Filter by period
        if ($request->filled('year')) {
            $year = $request->year;
            $yearStart = $year . '-01-01';
            $yearEnd = $year . '-12-31';
            $query->byPeriod($yearStart, $yearEnd);
        }
        
        // Search
        if ($request->filled('search')) {
            $query->search($request->search);
        }
        
        // Sort
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'oldest':
                $query->orderBy('published_at', 'asc');
                break;
            case 'most_viewed':
                $query->orderBy('views', 'desc');
                break;
            case 'most_downloaded':
                $query->orderBy('downloads', 'desc');
                break;
            case 'amount_high':
                $query->orderBy('amount', 'desc');
                break;
            case 'amount_low':
                $query->orderBy('amount', 'asc');
                break;
            default:
                $query->orderBy('published_at', 'desc');
        }
        
        $transparencies = $query->paginate(12);
        
        // Get featured items
        $featured = Transparency::published()->featured()
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();
        
        // Get statistics
        $stats = [
            'total_documents' => Transparency::published()->count(),
            'total_budget' => Transparency::published()->whereNotNull('amount')->sum('amount'),
            'total_projects' => Transparency::published()->byCategory('project')->count(),
            'total_views' => Transparency::published()->sum('views'),
            'categories' => Transparency::published()->selectRaw('category, COUNT(*) as count')
                ->groupBy('category')
                ->pluck('count', 'category')
                ->toArray(),
            'recent_updates' => Transparency::published()
                ->orderBy('published_at', 'desc')
                ->limit(5)
                ->get(['title', 'published_at', 'category'])
        ];
        
        // Get filter options
        $categories = self::getCategories();
        $types = self::getTypes();
        
        return view('transparency.index', compact('transparencies', 'featured', 'stats', 'categories', 'types'));
    }
    
    /**
     * Display specific transparency item
     */
    public function show(Transparency $transparency)
    {
        // Check if published
        if ($transparency->status !== 'published' || 
            !$transparency->published_at || 
            $transparency->published_at->isFuture()) {
            abort(404);
        }
        
        // Increment views
        $transparency->incrementViews();
        
        // Get related items
        $related = Transparency::published()
            ->where('id', '!=', $transparency->id)
            ->where('category', $transparency->category)
            ->orderBy('published_at', 'desc')
            ->limit(4)
            ->get();
        
        return view('transparency.show', compact('transparency', 'related'));
    }
    
    /**
     * Download file
     */
    public function download(Transparency $transparency, $fileIndex = 0)
    {
        // Check if published
        if ($transparency->status !== 'published' || 
            !$transparency->published_at || 
            $transparency->published_at->isFuture()) {
            abort(404);
        }
        
        if (!$transparency->files || !isset($transparency->files[$fileIndex])) {
            abort(404);
        }
        
        $filePath = $transparency->files[$fileIndex];
        
        if (!Storage::disk('public')->exists($filePath)) {
            abort(404);
        }
        
        // Increment downloads
        $transparency->incrementDownloads();
        
        return Storage::disk('public')->download($filePath);
    }
    
    /**
     * Display budget transparency
     */
    public function budget(Request $request)
    {
        $query = Transparency::published()
            ->byCategory('budget')
            ->whereNotNull('amount')
            ->with(['creator']);
        
        // Filter by year
        $currentYear = $request->filled('year') ? $request->year : date('Y');
        if ($request->filled('year')) {
            $year = $request->year;
            $yearStart = $year . '-01-01';
            $yearEnd = $year . '-12-31';
            $query->byPeriod($yearStart, $yearEnd);
        }
        
        $yearStart = $currentYear . '-01-01';
        $yearEnd = $currentYear . '-12-31';
        $budgets = $query->orderBy('period_start', 'desc')->paginate(10);
        
        // Get budget summary by year
        $budgetSummary = Transparency::published()
            ->byCategory('budget')
            ->whereNotNull('amount')
            ->whereNotNull('period_start')
            ->selectRaw('YEAR(period_start) as year, SUM(amount) as total_amount, COUNT(*) as count')
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->get();
        
        // Calculate stats for current year
        $yearStart = $currentYear . '-01-01';
        $yearEnd = $currentYear . '-12-31';
        $currentYearBudgets = Transparency::published()
            ->byCategory('budget')
            ->whereNotNull('amount')
            ->byPeriod($yearStart, $yearEnd)
            ->get();
        
        $totalBudget = $currentYearBudgets->sum('amount');
        // For published budget documents, consider them as realized
        $realizedBudget = $totalBudget; // All published budget is considered realized
        $remainingBudget = 0; // No remaining budget for published items
        $realizationPercentage = $totalBudget > 0 ? 100 : 0; // 100% if there's budget
        $totalDocuments = $currentYearBudgets->count();
        
        $stats = [
            'total_budget' => 'Rp ' . number_format($totalBudget, 0, ',', '.'),
            'realized_budget' => 'Rp ' . number_format($realizedBudget, 0, ',', '.'),
            'remaining_budget' => 'Rp ' . number_format($remainingBudget, 0, ',', '.'),
            'realization_percentage' => $realizationPercentage,
            'total_documents' => $totalDocuments
        ];
        
        // Create budget breakdown by category
        $budgetByCategory = $currentYearBudgets->groupBy('title')
            ->map(function ($items, $category) {
                return $items->sum('amount');
            })
            ->sortDesc();
        
        $colors = ['#3B82F6', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6', '#06B6D4', '#84CC16', '#F97316'];
        $budget_breakdown = [];
        $colorIndex = 0;
        
        foreach ($budgetByCategory as $category => $amount) {
            $percentage = $totalBudget > 0 ? round(($amount / $totalBudget) * 100, 1) : 0;
            $budget_breakdown[] = [
                'category' => $category ?: 'Lainnya',
                'amount' => 'Rp ' . number_format($amount, 0, ',', '.'),
                'percentage' => $percentage,
                'color' => $colors[$colorIndex % count($colors)]
            ];
            $colorIndex++;
        }
        
        // Create realization progress by month
        $realization_progress = [];
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        
        for ($i = 1; $i <= 12; $i++) {
            $monthStart = $currentYear . '-' . str_pad($i, 2, '0', STR_PAD_LEFT) . '-01';
            $monthEnd = $currentYear . '-' . str_pad($i, 2, '0', STR_PAD_LEFT) . '-' . date('t', strtotime($monthStart));
            
            $monthlyBudgets = Transparency::published()
                ->byCategory('budget')
                ->whereNotNull('amount')
                ->byPeriod($monthStart, $monthEnd)
                ->get();
            
            $monthlyAmount = $monthlyBudgets->sum('amount');
            $monthlyPercentage = $totalBudget > 0 ? round(($monthlyAmount / $totalBudget) * 100, 1) : 0;
            
            $realization_progress[] = [
                'month' => $months[$i - 1],
                'amount' => 'Rp ' . number_format($monthlyAmount, 0, ',', '.'),
                'percentage' => $monthlyPercentage
            ];
        }
        
        return view('transparency.budget', compact('budgets', 'budgetSummary', 'stats', 'budget_breakdown', 'realization_progress'));
    }
    
    /**
     * Display procurement transparency
     */
    public function procurement(Request $request)
    {
        $query = Transparency::published()
            ->byCategory('procurement')
            ->with(['creator']);
        
        // Filter by year
        if ($request->filled('year')) {
            $year = $request->year;
            $query->byPeriod(
                now()->setYear($year)->startOfYear(),
                now()->setYear($year)->endOfYear()
            );
        }
        
        $procurements = $query->orderBy('published_at', 'desc')->paginate(10);
        
        // Calculate statistics
        $allProcurements = Transparency::published()->byCategory('procurement')->get();
        $stats = [
            'total_procurements' => $allProcurements->count(),
            'completed_procurements' => $allProcurements->filter(function($item) {
                $data = json_decode($item->data, true);
                return isset($data['status']) && $data['status'] === 'completed';
            })->count(),
            'ongoing_procurements' => $allProcurements->filter(function($item) {
                $data = json_decode($item->data, true);
                return isset($data['status']) && in_array($data['status'], ['planning', 'tender', 'contract', 'ongoing']);
            })->count(),
            'total_value' => $allProcurements->sum('amount')
        ];
        
        return view('transparency.procurement', compact('procurements', 'stats'));
    }
    
    /**
     * Display project transparency
     */
    public function projects(Request $request)
    {
        $query = Transparency::published()
            ->byCategory('project')
            ->with(['creator']);
        
        // Filter by year
        if ($request->filled('year')) {
            $year = $request->year;
            $query->byPeriod(
                now()->setYear($year)->startOfYear(),
                now()->setYear($year)->endOfYear()
            );
        }
        
        $projects = $query->orderBy('published_at', 'desc')->paginate(10);
        
        // Calculate statistics
        $allProjects = Transparency::published()->byCategory('project')->get();
        $stats = [
            'total_projects' => $allProjects->count(),
            'completed_projects' => $allProjects->filter(function($item) {
                $data = json_decode($item->data, true);
                return isset($data['status']) && $data['status'] === 'completed';
            })->count(),
            'ongoing_projects' => $allProjects->filter(function($item) {
                $data = json_decode($item->data, true);
                return isset($data['status']) && in_array($data['status'], ['planning', 'ongoing']);
            })->count(),
            'total_budget' => $allProjects->sum('amount')
        ];
        
        return view('transparency.projects', compact('projects', 'stats'));
    }
    
    /**
     * Display regulations
     */
    public function regulations(Request $request)
    {
        $query = Transparency::published()
            ->byCategory('regulation')
            ->with(['creator']);
        
        // Search
        if ($request->filled('search')) {
            $query->search($request->search);
        }
        
        // Filter by year
        if ($request->filled('year')) {
            $year = $request->year;
            $query->byPeriod(
                now()->setYear($year)->startOfYear(),
                now()->setYear($year)->endOfYear()
            );
        }

        if ($request->filled('type')) {
            $query->whereJsonContains('data->regulation_type', $request->type);
        }

        if ($request->filled('status')) {
            $query->whereJsonContains('data->status', $request->status);
        }
        
        $regulations = $query->orderBy('published_at', 'desc')->paginate(10);
        
        $stats = [
            'total_regulations' => Transparency::published()->byCategory('regulation')->count(),
            'active_regulations' => Transparency::published()
                                               ->byCategory('regulation')
                                               ->whereJsonContains('data->status', 'active')
                                               ->count(),
            'recent_regulations' => Transparency::published()
                                               ->byCategory('regulation')
                                               ->where('published_at', '>=', now()->subDays(30))
                                               ->count(),
            'total_downloads' => Transparency::published()
                                            ->byCategory('regulation')
                                            ->sum('downloads')
        ];
        
        return view('transparency.regulations', compact('regulations', 'stats'));
    }
    
    /**
     * Display reports
     */
    public function reports(Request $request)
    {
        $query = Transparency::published()
            ->byCategory('report')
            ->with(['creator']);
        
        // Filter by year
        if ($request->filled('year')) {
            $year = $request->year;
            $query->byPeriod(
                now()->setYear($year)->startOfYear(),
                now()->setYear($year)->endOfYear()
            );
        }
        
        // Search
        if ($request->filled('search')) {
            $query->search($request->search);
        }
        
        if ($request->filled('type')) {
            $query->whereJsonContains('data->report_type', $request->type);
        }

        if ($request->filled('period')) {
            $query->whereJsonContains('data->period', $request->period);
        }
        
        $reports = $query->orderBy('published_at', 'desc')->paginate(10);
        
        $stats = [
            'total_reports' => Transparency::published()->byCategory('report')->count(),
            'this_year_reports' => Transparency::published()
                                              ->byCategory('report')
                                              ->whereYear('published_at', date('Y'))
                                              ->count(),
            'recent_reports' => Transparency::published()
                                           ->byCategory('report')
                                           ->where('published_at', '>=', now()->subDays(30))
                                           ->count(),
            'total_downloads' => Transparency::published()
                                            ->byCategory('report')
                                            ->sum('downloads')
        ];
        
        return view('transparency.reports', compact('reports', 'stats'));
    }
    
    /**
     * Get categories for filtering
     */
    public static function getCategories()
    {
        return [
            'budget' => 'Anggaran',
            'procurement' => 'Pengadaan',
            'project' => 'Proyek',
            'regulation' => 'Peraturan',
            'report' => 'Laporan',
            'other' => 'Lainnya',
        ];
    }
    
    /**
     * Get types for filtering
     */
    public static function getTypes()
    {
        return [
            'document' => 'Dokumen',
            'data' => 'Data',
            'announcement' => 'Pengumuman',
        ];
    }
}
