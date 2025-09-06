<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-50">
    <!-- Sidebar -->
    <div :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-50 w-72 bg-white border-r border-gray-200 shadow-lg transform transition-all duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0">
        <!-- Header -->
        <div class="flex items-center justify-center h-20 bg-white border-b border-gray-200">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-[#14213d] rounded-lg flex items-center justify-center">
                    <x-application-logo class="block h-6 w-auto fill-current text-white" />
                </div>
                <div>
                    <span class="text-xl font-bold text-[#14213d]">Website Camat</span>
                    <div class="text-xs text-gray-500">Portal Digital</div>
                </div>
            </div>
        </div>
        
        <nav class="mt-6 px-4">
            <div class="space-y-2">
                @hasrole('admin|super-admin')
                <!-- Dashboard Admin -->
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard*') ? 'bg-[#14213d] text-white shadow-md' : 'text-gray-700 hover:bg-gray-100 hover:text-[#14213d]' }} group flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200">
                    <div class="w-8 h-8 {{ request()->routeIs('dashboard*') ? 'bg-white/20' : 'bg-gray-100' }} rounded-lg flex items-center justify-center mr-3">
                        <svg class="h-4 w-4 {{ request()->routeIs('dashboard*') ? 'text-white' : 'text-[#14213d]' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                        </svg>
                    </div>
                    <span class="font-medium">Dashboard</span>
                </a>

                <!-- Manajemen Konten -->
                <div x-data="{ open: false }" class="mb-2">
                    <button @click="open = !open" class="w-full text-gray-700 hover:bg-gray-100 hover:text-[#14213d] group flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200">
                        <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center mr-3">
                            <svg class="h-4 w-4 text-[#14213d]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                        </div>
                        <span class="font-medium flex-1 text-left">Manajemen Konten</span>
                        <svg class="h-4 w-4 transform transition-transform duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform -translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" class="ml-12 mt-2 space-y-1">
                        <a href="{{ route('admin.news.index') }}" class="{{ request()->routeIs('admin.news.*') ? 'bg-[#14213d]/10 text-[#14213d] border-l-2 border-[#14213d]' : 'text-gray-600 hover:text-[#14213d] hover:bg-gray-50' }} group flex items-center px-3 py-2 text-sm rounded-lg transition-all duration-200">
                            <div class="w-2 h-2 bg-[#14213d] rounded-full mr-3"></div>
                            Berita
                        </a>
                        <a href="{{ route('admin.gallery.index') }}" class="{{ request()->routeIs('admin.gallery.*') ? 'bg-[#14213d]/10 text-[#14213d] border-l-2 border-[#14213d]' : 'text-gray-600 hover:text-[#14213d] hover:bg-gray-50' }} group flex items-center px-3 py-2 text-sm rounded-lg transition-all duration-200">
                            <div class="w-2 h-2 bg-emerald-500 rounded-full mr-3"></div>
                            Galeri
                        </a>
                    </div>
                </div>

                <!-- Manajemen User -->
                <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'bg-[#14213d] text-white shadow-md' : 'text-gray-700 hover:bg-gray-100 hover:text-[#14213d]' }} group flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200">
                    <div class="w-8 h-8 {{ request()->routeIs('admin.users.*') ? 'bg-white/20' : 'bg-gray-100' }} rounded-lg flex items-center justify-center mr-3">
                        <svg class="h-4 w-4 {{ request()->routeIs('admin.users.*') ? 'text-white' : 'text-[#14213d]' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                    </div>
                    <span class="font-medium">Manajemen User</span>
                </a>
                @endhasrole

                @hasrole('staff')
                <!-- Dashboard Staff -->
                <a href="{{ route('staff.dashboard') }}" class="{{ request()->routeIs('staff.dashboard*') ? 'bg-[#14213d] text-white shadow-md' : 'text-gray-700 hover:bg-gray-100 hover:text-[#14213d]' }} group flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200">
                    <div class="w-8 h-8 {{ request()->routeIs('staff.dashboard*') ? 'bg-white/20' : 'bg-gray-100' }} rounded-lg flex items-center justify-center mr-3">
                        <svg class="h-4 w-4 {{ request()->routeIs('staff.dashboard*') ? 'text-white' : 'text-[#14213d]' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                        </svg>
                    </div>
                    <span class="font-medium">Dashboard</span>
                </a>
                @endhasrole

                @hasrole('staff|admin|super-admin')
                <!-- Layanan Administrasi -->
                <div x-data="{ open: false }" class="mb-2">
                    <button @click="open = !open" class="w-full text-gray-700 hover:bg-gray-100 hover:text-[#14213d] group flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200">
                        <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center mr-3">
                            <svg class="h-4 w-4 text-[#14213d]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <span class="font-medium flex-1 text-left">Layanan Administrasi</span>
                        <svg class="h-4 w-4 transform transition-transform duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform -translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" class="ml-12 mt-2 space-y-1">
                        @hasrole('admin|super-admin')
                        <a href="{{ route('admin.documents.index') }}" class="{{ request()->routeIs('admin.documents.*') ? 'bg-[#14213d]/10 text-[#14213d] border-l-2 border-[#14213d]' : 'text-gray-600 hover:text-[#14213d] hover:bg-gray-50' }} group flex items-center px-3 py-2 text-sm rounded-lg transition-all duration-200">
                            <div class="w-2 h-2 bg-orange-500 rounded-full mr-3"></div>
                            Manajemen Dokumen
                        </a>

                        @endhasrole
                        @hasrole('staff')
                        <a href="{{ route('staff.documents.index') }}" class="{{ request()->routeIs('staff.documents.*') ? 'bg-[#14213d]/10 text-[#14213d] border-l-2 border-[#14213d]' : 'text-gray-600 hover:text-[#14213d] hover:bg-gray-50' }} group flex items-center px-3 py-2 text-sm rounded-lg transition-all duration-200">
                            <div class="w-2 h-2 bg-orange-500 rounded-full mr-3"></div>
                            Manajemen Dokumen
                        </a>

                        @endhasrole
                    </div>
                </div>

                @hasrole('admin|super-admin')
                <!-- Pengaduan -->
                <a href="{{ route('admin.complaints.index') }}" class="{{ request()->routeIs('admin.complaints.*') ? 'bg-[#14213d] text-white shadow-md' : 'text-gray-700 hover:bg-gray-100 hover:text-[#14213d]' }} group flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200">
                    <div class="w-8 h-8 {{ request()->routeIs('admin.complaints.*') ? 'bg-white/20' : 'bg-gray-100' }} rounded-lg flex items-center justify-center mr-3">
                        <svg class="h-4 w-4 {{ request()->routeIs('admin.complaints.*') ? 'text-white' : 'text-[#14213d]' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </div>
                    <span class="font-medium">Pengaduan</span>
                </a>
                @endhasrole


                @endhasrole

                @hasrole('staff')
                <!-- Pengaduan Staff -->
                <a href="{{ route('staff.complaints.index') }}" class="{{ request()->routeIs('staff.complaints.*') ? 'bg-[#14213d] text-white shadow-md' : 'text-gray-700 hover:bg-gray-100 hover:text-[#14213d]' }} group flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200">
                    <div class="w-8 h-8 {{ request()->routeIs('staff.complaints.*') ? 'bg-white/20' : 'bg-gray-100' }} rounded-lg flex items-center justify-center mr-3">
                        <svg class="h-4 w-4 {{ request()->routeIs('staff.complaints.*') ? 'text-white' : 'text-[#14213d]' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </div>
                    <span class="font-medium">Pengaduan</span>
                </a>
                @endhasrole

                @hasrole('staff|admin|super-admin')
                <!-- Transparansi -->
                <div x-data="{ open: false }" class="mb-2">
                    <button @click="open = !open" class="w-full text-gray-700 hover:bg-gray-100 hover:text-[#14213d] group flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200">
                        <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center mr-3">
                            <svg class="h-4 w-4 text-[#14213d]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                        <span class="font-medium flex-1 text-left">Transparansi</span>
                        <svg class="h-4 w-4 transform transition-transform duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform -translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" class="ml-12 mt-2 space-y-1">
                        @hasrole('admin|super-admin')
                        <a href="{{ route('admin.transparency.index') }}" class="{{ request()->routeIs('admin.transparency.*') ? 'bg-[#14213d]/10 text-[#14213d] border-l-2 border-[#14213d]' : 'text-gray-600 hover:text-[#14213d] hover:bg-gray-50' }} group flex items-center px-3 py-2 text-sm rounded-lg transition-all duration-200">
                            <div class="w-2 h-2 bg-teal-500 rounded-full mr-3"></div>
                            Data Transparansi
                        </a>
                        <a href="{{ route('admin.transparency.create') }}" class="{{ request()->routeIs('admin.transparency.create') ? 'bg-[#14213d]/10 text-[#14213d] border-l-2 border-[#14213d]' : 'text-gray-600 hover:text-[#14213d] hover:bg-gray-50' }} group flex items-center px-3 py-2 text-sm rounded-lg transition-all duration-200">
                            <div class="w-2 h-2 bg-cyan-500 rounded-full mr-3"></div>
                            Tambah Data
                        </a>
                        @endhasrole
                        @hasrole('staff')
                        <a href="{{ route('staff.transparency.index') }}" class="{{ request()->routeIs('staff.transparency.*') ? 'bg-[#14213d]/10 text-[#14213d] border-l-2 border-[#14213d]' : 'text-gray-600 hover:text-[#14213d] hover:bg-gray-50' }} group flex items-center px-3 py-2 text-sm rounded-lg transition-all duration-200">
                            <div class="w-2 h-2 bg-teal-500 rounded-full mr-3"></div>
                            Data Transparansi
                        </a>
                        <a href="{{ route('staff.transparency.create') }}" class="{{ request()->routeIs('staff.transparency.create') ? 'bg-[#14213d]/10 text-[#14213d] border-l-2 border-[#14213d]' : 'text-gray-600 hover:text-[#14213d] hover:bg-gray-50' }} group flex items-center px-3 py-2 text-sm rounded-lg transition-all duration-200">
                            <div class="w-2 h-2 bg-cyan-500 rounded-full mr-3"></div>
                            Tambah Data
                        </a>
                        @endhasrole
                        <a href="{{ route('transparency.index') }}" class="text-gray-600 hover:text-[#14213d] hover:bg-gray-50 group flex items-center px-3 py-2 text-sm rounded-lg transition-all duration-200" target="_blank">
                            <div class="w-2 h-2 bg-indigo-500 rounded-full mr-3"></div>
                            Lihat Portal
                        </a>
                    </div>
                </div>
                @endhasrole

                @hasrole('user')
                <!-- Dashboard -->
                <a href="{{ route('user.dashboard') }}" class="{{ request()->routeIs('user.dashboard') || request()->routeIs('dashboard') ? 'bg-[#14213d] text-white shadow-md' : 'text-gray-700 hover:bg-gray-100 hover:text-[#14213d]' }} group flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200">
                    <div class="w-8 h-8 {{ request()->routeIs('user.dashboard') || request()->routeIs('dashboard') ? 'bg-white/20' : 'bg-gray-100' }} rounded-lg flex items-center justify-center mr-3">
                        <svg class="h-4 w-4 {{ request()->routeIs('user.dashboard') || request()->routeIs('dashboard') ? 'text-white' : 'text-[#14213d]' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6a2 2 0 01-2 2H10a2 2 0 01-2-2V5z"></path>
                        </svg>
                    </div>
                    <span class="font-medium">Dashboard</span>
                </a>

                <!-- Status Pengajuan -->
                <a href="{{ route('documents.index') }}" class="{{ request()->routeIs('documents.*') ? 'bg-[#14213d] text-white shadow-md' : 'text-gray-700 hover:bg-gray-100 hover:text-[#14213d]' }} group flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200">
                    <div class="w-8 h-8 {{ request()->routeIs('documents.*') ? 'bg-white/20' : 'bg-gray-100' }} rounded-lg flex items-center justify-center mr-3">
                        <svg class="h-4 w-4 {{ request()->routeIs('documents.*') ? 'text-white' : 'text-[#14213d]' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <span class="font-medium">Status Pengajuan</span>
                </a>

                <!-- Pengaduan Saya -->
                <a href="{{ route('complaints.index') }}" class="{{ request()->routeIs('complaints.*') ? 'bg-[#14213d] text-white shadow-md' : 'text-gray-700 hover:bg-gray-100 hover:text-[#14213d]' }} group flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200">
                    <div class="w-8 h-8 {{ request()->routeIs('complaints.*') ? 'bg-white/20' : 'bg-gray-100' }} rounded-lg flex items-center justify-center mr-3">
                        <svg class="h-4 w-4 {{ request()->routeIs('complaints.*') ? 'text-white' : 'text-[#14213d]' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </div>
                    <span class="font-medium">Pengaduan Saya</span>
                </a>



                <!-- Profil Saya -->
                <a href="{{ route('profile.edit') }}" class="{{ request()->routeIs('profile.*') ? 'bg-[#14213d] text-white shadow-md' : 'text-gray-700 hover:bg-gray-100 hover:text-[#14213d]' }} group flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200">
                    <div class="w-8 h-8 {{ request()->routeIs('profile.*') ? 'bg-white/20' : 'bg-gray-100' }} rounded-lg flex items-center justify-center mr-3">
                         <svg class="h-4 w-4 {{ request()->routeIs('profile.*') ? 'text-white' : 'text-[#14213d]' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <span class="font-medium">Profil Saya</span>
                </a>

                <!-- Informasi Transparansi -->
                <a href="{{ route('transparency.index') }}" class="{{ request()->routeIs('transparency.*') ? 'bg-[#14213d] text-white shadow-md' : 'text-gray-700 hover:bg-gray-100 hover:text-[#14213d]' }} group flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200" target="_blank">
                    <div class="w-8 h-8 {{ request()->routeIs('transparency.*') ? 'bg-white/20' : 'bg-gray-100' }} rounded-lg flex items-center justify-center mr-3">
                        <svg class="h-4 w-4 {{ request()->routeIs('transparency.*') ? 'text-white' : 'text-[#14213d]' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <span class="font-medium">Informasi Transparansi</span>
                </a>
                @endhasrole
            </div>


        </nav>
    </div>

    <!-- Mobile sidebar overlay -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-gray-600 bg-opacity-75 lg:hidden" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>

    <!-- Main content -->
    <div class="flex-1 flex flex-col overflow-hidden lg:ml-0">
        <!-- Top bar -->
        <header class="bg-white shadow-sm border-b border-gray-200 w-full">
            <div class="flex items-center justify-between px-4 py-3 w-full">
                <div class="flex items-center space-x-4">
                    <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 hover:text-gray-600 lg:hidden">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                    
                    @isset($header)
                        <div class="flex-1">
                            {{ $header }}
                        </div>
                    @endisset
                </div>

                <!-- User Profile & Notification -->
                <div class="flex items-center space-x-4 ml-auto">
                    @auth
                        <!-- Notification Bell -->
                        <x-notification-bell :unreadCount="$unreadNotificationCount ?? 0" />
                        
                        <!-- User Profile Dropdown -->
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" class="flex items-center space-x-2 text-gray-700 hover:text-[#14213d] transition-colors duration-200">
                                <div class="w-8 h-8 bg-[#14213d] rounded-full flex items-center justify-center">
                                    <svg class="h-4 w-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <span class="font-medium text-sm hidden md:block">{{ Auth::user()->name }}</span>
                                <svg class="h-4 w-4 transform transition-transform duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            
                            <!-- Dropdown Menu -->
                            <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-1 z-[9999]">
                                <a href="{{ route('profile.edit') }}" class="{{ request()->routeIs('profile.edit') ? 'bg-[#14213d]/10 text-[#14213d]' : 'text-gray-700 hover:bg-gray-50 hover:text-[#14213d]' }} flex items-center px-4 py-2 text-sm transition-colors duration-200">
                                    <svg class="h-4 w-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Edit Profile
                                </a>
                                <hr class="my-1 border-gray-200">
                                <form method="POST" action="{{ route('logout') }}" class="inline w-full">
                                    @csrf
                                    <button type="submit" class="w-full text-left text-gray-700 hover:bg-red-50 hover:text-red-600 flex items-center px-4 py-2 text-sm transition-colors duration-200">
                                        <svg class="h-4 w-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                        </svg>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endauth
                </div>
            </div>
        </header>

        <!-- Page content -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6 min-h-0">
            <div class="max-w-7xl mx-auto">
                @yield('content')
            </div>
        </main>
    </div>
</div>

@push('scripts')
<!-- Notification Script -->
<script src="{{ asset('js/notifications.js') }}"></script>

<script>
    // Initialize sidebar and notification functionality
    document.addEventListener('DOMContentLoaded', function() {
        // Wait for Alpine.js to be ready before initializing notifications
        document.addEventListener('alpine:init', () => {
            console.log('Alpine.js initialized in sidebar');
            // Initialize notification manager after Alpine is ready
            setTimeout(() => {
                if (window.NotificationManager) {
                    window.notificationManager = new NotificationManager();
                    console.log('NotificationManager initialized');
                }
            }, 500);
        });
        
        // Auto-collapse sidebar on mobile after navigation
        const sidebarLinks = document.querySelectorAll('.sidebar-link');
        sidebarLinks.forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 768) {
                    // Close sidebar on mobile
                    const sidebar = document.querySelector('[x-data]');
                    if (sidebar && sidebar.__x) {
                        sidebar.__x.$data.sidebarOpen = false;
                    }
                }
            });
        });
    });
</script>
@endpush