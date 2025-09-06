@extends('layouts.app')

@section('title', 'Manajemen Pengaduan')

@section('content')

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Alert Messages -->
            @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-6 py-4 rounded-lg shadow-sm" role="alert">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-6 py-4 rounded-lg shadow-sm" role="alert">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-red-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="font-medium">{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            <!-- Header Actions -->
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl mb-8">
                <div class="px-6 py-8 sm:px-8">
                    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-2">Daftar Pengaduan</h3>
                            <p class="text-gray-600 leading-relaxed">Kelola dan pantau status pengaduan Anda dengan mudah</p>
                        </div>
                        <a href="{{ route('complaints.create') }}" class="inline-flex items-center px-6 py-3 bg-[#14213d] border border-transparent rounded-lg font-semibold text-sm text-white hover:bg-[#0f1a2e] focus:bg-[#0f1a2e] active:bg-[#0a1423] focus:outline-none focus:ring-2 focus:ring-[#14213d] focus:ring-offset-2 transition-all duration-300 shadow-md hover:shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Buat Pengaduan Baru
                        </a>
                    </div>
                </div>
            </div>

            <!-- Filter and Search -->
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl mb-8">
                <div class="px-6 py-8 sm:px-8">
                    <h4 class="text-lg font-semibold text-gray-900 mb-6">Filter & Pencarian</h4>
                    <form method="GET" action="{{ route('complaints.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <div>
                            <label for="search" class="block text-sm font-semibold text-gray-700 mb-2">Cari Pengaduan</label>
                            <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Nomor tiket atau subjek..." class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#14213d] focus:ring-[#14213d] focus:ring-2 transition-colors duration-300 px-4 py-3">
                        </div>
                        <div>
                            <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                            <select name="status" id="status" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#14213d] focus:ring-[#14213d] focus:ring-2 transition-colors duration-300 px-4 py-3">
                                <option value="">Semua Status</option>
                                <option value="open" {{ request('status') == 'open' ? 'selected' : '' }}>Terbuka</option>
                                <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>Sedang Diproses</option>
                                <option value="resolved" {{ request('status') == 'resolved' ? 'selected' : '' }}>Selesai</option>
                                <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Ditutup</option>
                            </select>
                        </div>
                        <div>
                            <label for="category" class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                            <select name="category" id="category" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#14213d] focus:ring-[#14213d] focus:ring-2 transition-colors duration-300 px-4 py-3">
                                <option value="">Semua Kategori</option>
                                @foreach(App\Http\Controllers\ComplaintController::getCategories() as $key => $value)
                                    <option value="{{ $key }}" {{ request('category') == $key ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex items-end">
                            <button type="submit" class="w-full inline-flex justify-center items-center px-6 py-3 bg-[#14213d] border border-transparent rounded-lg font-semibold text-sm text-white hover:bg-[#0f1a2e] focus:bg-[#0f1a2e] active:bg-[#0a1423] focus:outline-none focus:ring-2 focus:ring-[#14213d] focus:ring-offset-2 transition-all duration-300 shadow-md hover:shadow-lg">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                Cari & Filter
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Complaints List -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($complaints->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nomor Tiket</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subjek</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prioritas</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($complaints as $complaint)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $complaint->ticket_number }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-900">
                                                <div class="max-w-xs truncate" title="{{ $complaint->subject }}">{{ $complaint->subject }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ App\Http\Controllers\ComplaintController::getCategories()[$complaint->category] ?? $complaint->category }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {!! $complaint->status_badge !!}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {!! $complaint->priority_badge !!}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $complaint->created_at->format('d/m/Y H:i') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <div class="flex space-x-2">
                                                    <a href="{{ route('complaints.show', $complaint) }}" class="text-[#14213d] hover:text-[#0f1a2e] transition duration-300" title="Lihat Detail">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                        </svg>
                                                    </a>
                                                    @if(in_array($complaint->status, ['open', 'in_progress']))
                                                        <a href="{{ route('complaints.edit', $complaint) }}" class="text-yellow-600 hover:text-yellow-800 transition duration-300" title="Edit">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                            </svg>
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-6">
                            {{ $complaints->appends(request()->query())->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada pengaduan</h3>
                            <p class="mt-1 text-sm text-gray-500">Mulai dengan membuat pengaduan pertama Anda.</p>
                            <div class="mt-6">
                                <a href="{{ route('complaints.create') }}" class="inline-flex items-center px-6 py-3 bg-[#14213d] border border-transparent rounded-lg font-semibold text-sm text-white hover:bg-[#0f1a2e] focus:bg-[#0f1a2e] active:bg-[#0a1423] focus:outline-none focus:ring-2 focus:ring-[#14213d] focus:ring-offset-2 transition-all duration-300 shadow-md hover:shadow-lg">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    Buat Pengaduan Baru
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
