<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Gallery;
use App\Models\VillageInfo;
use App\Models\User;
use App\Models\Complaint;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the home page
     */
    public function index()
    {
        // Get latest news (published only)
        $latestNews = News::where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        // Get latest gallery items
        $latestGallery = Gallery::orderBy('created_at', 'desc')
            ->take(8)
            ->get();

        // Get village information
        $villageInfo = VillageInfo::first();

        // Get statistics
        $statistics = [
            'total_users' => User::role('user')->count(),
            'total_news' => News::where('status', 'published')->count(),
            'total_gallery' => Gallery::count(),
            'total_complaints' => Complaint::count(),
            'pending_complaints' => Complaint::where('status', 'pending')->count(),
        ];

        return view('home', compact('latestNews', 'latestGallery', 'villageInfo', 'statistics'));
    }

    /**
     * Display news page
     */
    public function news()
    {
        $news = News::where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('news.index', compact('news'));
    }

    /**
     * Display single news
     */
    public function showNews($id)
    {
        $news = News::where('status', 'published')->findOrFail($id);
        
        // Increment view count
        $news->increment('views');
        
        // Get related news
        $relatedNews = News::where('status', 'published')
            ->where('id', '!=', $id)
            ->where('category', $news->category)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        return view('news.show', compact('news', 'relatedNews'));
    }

    /**
     * Display gallery page
     */
    public function gallery()
    {
        $galleries = Gallery::orderBy('created_at', 'desc')
            ->paginate(16);

        return view('gallery.index', compact('galleries'));
    }

    /**
     * Display village information
     */
    public function about()
    {
        $villageInfo = VillageInfo::first();
        
        return view('about', compact('villageInfo'));
    }

    /**
     * Display contact page
     */
    public function contact()
    {
        $villageInfo = VillageInfo::first();
        
        return view('contact', compact('villageInfo'));
    }
    
    /**
     * Handle contact form submission
     */
    public function sendContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:1000'
        ]);
        
        // Di sini bisa ditambahkan logic untuk menyimpan pesan atau mengirim email
        // Untuk sementara, kita redirect dengan pesan sukses
        
        return redirect()->route('contact')
                        ->with('success', 'Pesan Anda telah terkirim. Kami akan merespon dalam 1x24 jam.');
    }
}