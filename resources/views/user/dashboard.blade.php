@extends('layouts.app')

@section('title', 'dashboard warga ')

@section('content')

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">


            <!-- Welcome Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl mb-8">
                <div class="px-6 py-8 sm:px-8">
                    <div class="text-center mb-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">Selamat datang, {{ Auth::user()->name }}!</h3>
                        <p class="text-lg text-gray-600 max-w-2xl mx-auto">Akses layanan administrasi kecamatan dengan mudah dan cepat melalui portal digital kami.</p>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Documents -->
                <div class="bg-white overflow-hidden shadow-sm rounded-xl">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Total Dokumen</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $stats['total_documents'] ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Documents -->
                <div class="bg-white overflow-hidden shadow-sm rounded-xl">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-yellow-500 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Menunggu Proses</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $stats['pending_documents'] ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Completed Documents -->
                <div class="bg-white overflow-hidden shadow-sm rounded-xl">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-green-500 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Selesai</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $stats['completed_documents'] ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Complaints -->
                <div class="bg-white overflow-hidden shadow-sm rounded-xl">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-red-500 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Total Pengaduan</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $stats['total_complaints'] ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl mb-8">
                <div class="px-6 py-8 sm:px-8">
                    <h4 class="text-2xl font-bold text-gray-900 mb-6">Aksi Cepat</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($quickActions ?? [] as $action)
                        <a href="{{ route($action['route']) }}" class="
                            @if($action['color'] == 'blue') bg-gradient-to-br from-blue-50 to-blue-100 border-blue-200 hover:border-blue-300
                            @elseif($action['color'] == 'red') bg-gradient-to-br from-red-50 to-red-100 border-red-200 hover:border-red-300
                            @elseif($action['color'] == 'green') bg-gradient-to-br from-green-50 to-green-100 border-green-200 hover:border-green-300
                            @elseif($action['color'] == 'purple') bg-gradient-to-br from-purple-50 to-purple-100 border-purple-200 hover:border-purple-300
                            @endif
                            p-6 rounded-xl border hover:shadow-lg transition-all duration-300 group">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 rounded-lg flex items-center justify-center mr-3 group-hover:scale-110 transition-transform duration-300
                                    @if($action['color'] == 'blue') bg-blue-500
                                    @elseif($action['color'] == 'red') bg-red-500
                                    @elseif($action['color'] == 'green') bg-green-500
                                    @elseif($action['color'] == 'purple') bg-purple-500
                                    @endif">
                                    @if($action['icon'] == 'document-text')
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    @elseif($action['icon'] == 'chat-bubble-left-right')
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                    </svg>
                                    @elseif($action['icon'] == 'clipboard-document-list')
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                    </svg>
                                    @elseif($action['icon'] == 'eye')
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    @endif
                                </div>
                                <h5 class="text-lg font-bold
                                    @if($action['color'] == 'blue') text-blue-700
                                    @elseif($action['color'] == 'red') text-red-700
                                    @elseif($action['color'] == 'green') text-green-700
                                    @elseif($action['color'] == 'purple') text-purple-700
                                    @endif">{{ $action['title'] }}</h5>
                            </div>
                            <p class="text-sm
                                @if($action['color'] == 'blue') text-blue-600
                                @elseif($action['color'] == 'red') text-red-600
                                @elseif($action['color'] == 'green') text-green-600
                                @elseif($action['color'] == 'purple') text-purple-600
                                @endif">{{ $action['description'] }}</p>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <!-- Recent Documents -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl">
                    <div class="px-6 py-8 sm:px-8">
                        <div class="flex items-center justify-between mb-6">
                            <h4 class="text-xl font-bold text-gray-900">Dokumen Terbaru</h4>
                            <a href="{{ route('documents.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Lihat Semua</a>
                        </div>
                        @if(isset($recentDocuments) && $recentDocuments->count() > 0)
                            <div class="space-y-4">
                                @foreach($recentDocuments ?? [] as $document)
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-900">{{ $document->document_type_label ?? 'Dokumen' }}</p>
                                            <p class="text-sm text-gray-500">{{ $document->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    <span class="px-3 py-1 text-xs font-medium rounded-full
                                        @if($document->status == 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($document->status == 'approved') bg-green-100 text-green-800
                                        @elseif($document->status == 'completed') bg-blue-100 text-blue-800
                                        @else bg-red-100 text-red-800
                                        @endif">
                                        {{ ucfirst($document->status) }}
                                    </span>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <p class="text-gray-500">Belum ada dokumen yang diajukan</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Recent Complaints -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl">
                    <div class="px-6 py-8 sm:px-8">
                        <div class="flex items-center justify-between mb-6">
                            <h4 class="text-xl font-bold text-gray-900">Pengaduan Terbaru</h4>
                            <a href="{{ route('complaints.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Lihat Semua</a>
                        </div>
                        @if(isset($recentComplaints) && $recentComplaints->count() > 0)
                            <div class="space-y-4">
                                @foreach($recentComplaints ?? [] as $complaint)
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-900">{{ Str::limit($complaint->subject, 30) }}</p>
                                            <p class="text-sm text-gray-500">{{ $complaint->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    <span class="px-3 py-1 text-xs font-medium rounded-full
                                        @if($complaint->status == 'open') bg-yellow-100 text-yellow-800
                                        @elseif($complaint->status == 'in_progress') bg-blue-100 text-blue-800
                                        @elseif($complaint->status == 'resolved') bg-green-100 text-green-800
                                        @else bg-gray-100 text-gray-800
                                        @endif">
                                        {{ ucfirst($complaint->status) }}
                                    </span>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                    </svg>
                                </div>
                                <p class="text-gray-500">Belum ada pengaduan yang dibuat</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Latest News & Transparency -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Latest News -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl">
                    <div class="px-6 py-8 sm:px-8">
                        <div class="flex items-center justify-between mb-6">
                            <h4 class="text-xl font-bold text-gray-900">Berita Terbaru</h4>
                            <a href="{{ route('news.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Lihat Semua</a>
                        </div>
                        @if(isset($latestNews) && $latestNews->count() > 0)
                            <div class="space-y-4">
                                @foreach($latestNews ?? [] as $news)
                                <div class="flex items-start space-x-4">
                                    @if($news->featured_image)
                                    <img src="{{ Storage::url($news->featured_image) }}" alt="{{ $news->title }}" class="w-16 h-16 object-cover rounded-lg">
                                    @else
                                    <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                        </svg>
                                    </div>
                                    @endif
                                    <div class="flex-1">
                                        <h5 class="font-medium text-gray-900 mb-1">{{ Str::limit($news->title, 50) }}</h5>
                                        <p class="text-sm text-gray-500">{{ $news->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <p class="text-gray-500">Belum ada berita terbaru</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Recent Transparency -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl">
                    <div class="px-6 py-8 sm:px-8">
                        <div class="flex items-center justify-between mb-6">
                            <h4 class="text-xl font-bold text-gray-900">Data Transparansi</h4>
                            <a href="{{ route('transparency.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Lihat Semua</a>
                        </div>
                        @if(isset($recentTransparency) && $recentTransparency->count() > 0)
                            <div class="space-y-4">
                                @foreach($recentTransparency ?? [] as $transparency)
                                <div class="flex items-start space-x-4">
                                    <div class="w-16 h-16 bg-green-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h5 class="font-medium text-gray-900 mb-1">{{ Str::limit($transparency->title, 50) }}</h5>
                                        <p class="text-sm text-gray-500">{{ $transparency->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <p class="text-gray-500">Belum ada data transparansi</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection