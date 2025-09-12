@props(['unreadCount' => 0])

<div class="relative" x-data="{ open: false }">
    <!-- Notification Bell Button -->
    <button @click="open = !open" 
            class="relative p-2 text-gray-600 hover:text-[#14213d] hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-[#14213d] focus:ring-offset-2 rounded-lg transition-all duration-200">
        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM4 17h5l5 5v-5zM18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9zM13.73 21a2 2 0 01-3.46 0"></path>
        </svg>
        
        <!-- Unread Badge -->
        <span id="notification-badge" 
              class="absolute -top-1 -right-1 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-500 rounded-full min-w-[20px] h-5 {{ $unreadCount > 0 ? '' : 'hidden' }}">
            {{ $unreadCount > 99 ? '99+' : $unreadCount }}
        </span>
    </button>

    <!-- Notification Dropdown -->
    <div x-show="open" 
         @click.away="open = false"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg border border-gray-200 z-[9999]">
        
        <!-- Header -->
        <div class="px-4 py-3 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h3 class="text-sm font-semibold text-gray-800">Notifikasi</h3>
                <div class="flex items-center space-x-2">
                    <button id="refresh-notifications" 
                            class="text-xs text-gray-500 hover:text-[#14213d] transition-colors p-1 rounded">
                        <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                    </button>
                    <button id="mark-all-read" 
                            class="text-xs text-[#14213d] hover:text-blue-700 transition-colors px-2 py-1 rounded bg-[#14213d]/10 hover:bg-[#14213d]/20">
                        Tandai Semua Dibaca
                    </button>
                </div>
            </div>
        </div>

        <!-- Notifications List -->
        <div class="max-h-96 overflow-y-auto">
            <div id="notifications-list">
                <!-- Notifications will be loaded here by JavaScript -->
                <div class="flex flex-col items-center justify-center py-8 text-gray-500">
                    <i class="fas fa-spinner fa-spin text-2xl mb-2"></i>
                    <p class="text-sm">Memuat notifikasi...</p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="px-4 py-3 border-t border-gray-200 bg-gray-50 rounded-b-lg">
            <a href="{{ route('admin.notifications.index') }}" 
               class="block text-center text-sm text-[#14213d] hover:text-blue-700 font-medium transition-colors">
                Lihat Semua Notifikasi
            </a>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Auto-refresh notifications every 30 seconds
    document.addEventListener('DOMContentLoaded', function() {
        // Wait a bit for notification manager to be initialized
        setTimeout(() => {
            setInterval(() => {
                if (window.notificationManager) {
                    window.notificationManager.loadNotifications();
                }
            }, 30000);
            
            // Force update badge on page load
            if (window.notificationManager) {
                window.notificationManager.updateUnreadCount();
            }
        }, 1000);
    });
</script>
@endpush