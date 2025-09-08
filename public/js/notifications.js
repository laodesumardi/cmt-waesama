// Real-time Notifications System
class NotificationManager {
    constructor() {
        this.notifications = [];
        this.unreadCount = 0;
        this.init();
    }

    init() {
        this.loadNotifications();
        this.setupEventListeners();
        this.setupPusher();
        this.updateUnreadCount();
    }

    setupPusher() {
        if (typeof Pusher !== 'undefined' && window.pusherKey) {
            const pusher = new Pusher(window.pusherKey, {
                cluster: window.pusherCluster || 'ap1',
                encrypted: true
            });

            const userId = document.querySelector('meta[name="user-id"]')?.content;
            if (userId) {
                const channel = pusher.subscribe(`user.${userId}`);
                channel.bind('notification.sent', (data) => {
                    this.handleNewNotification(data);
                });
            }
        }
    }

    setupEventListeners() {
        // Mark as read and navigate when clicked
        document.addEventListener('click', (e) => {
            const notificationItem = e.target.closest('.notification-item');
            if (notificationItem) {
                // Don't navigate if clicking on the "Lihat Detail" link directly
                if (e.target.closest('a[href]')) {
                    return;
                }
                
                const notificationId = notificationItem.dataset.id;
                const notification = this.notifications.find(n => n.id == notificationId);
                
                // Mark as read
                this.markAsRead(notificationId);
                
                // Navigate to detail page if action_url exists
                if (notification && notification.action_url) {
                    setTimeout(() => {
                        window.location.href = notification.action_url;
                    }, 100); // Small delay to ensure mark as read completes
                }
            }
        });

        // Mark all as read button
        const markAllBtn = document.getElementById('mark-all-read');
        if (markAllBtn) {
            markAllBtn.addEventListener('click', () => this.markAllAsRead());
        }

        // Refresh notifications
        const refreshBtn = document.getElementById('refresh-notifications');
        if (refreshBtn) {
            refreshBtn.addEventListener('click', () => this.loadNotifications());
        }
    }

    async loadNotifications() {
        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            const response = await fetch('/notifications/api', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                credentials: 'same-origin'
            });
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            const data = await response.json();
            
            this.notifications = data.notifications || [];
            this.unreadCount = data.unread_count || 0;
            this.renderNotifications();
            this.updateUnreadCount();
        } catch (error) {
            console.error('Error loading notifications:', error);
            // Handle error gracefully - show empty state
            this.notifications = [];
            this.unreadCount = 0;
            this.renderNotifications();
            this.updateUnreadCount();
        }
    }

    handleNewNotification(data) {
        // Add to notifications array
        this.notifications.unshift(data.notification);
        
        // Update UI
        this.renderNotifications();
        this.updateUnreadCount();
        
        // Show toast notification
        this.showToast(data.notification);
        
        // Play sound if enabled
        this.playNotificationSound();
    }

    renderNotifications() {
        const container = document.getElementById('notifications-list');
        if (!container) return;

        container.innerHTML = '';
        
        if (this.notifications.length === 0) {
            container.innerHTML = `
                <div class="text-center py-8 text-gray-500">
                    <i class="fas fa-bell-slash text-4xl mb-2"></i>
                    <p>Tidak ada notifikasi</p>
                </div>
            `;
            return;
        }

        this.notifications.forEach(notification => {
            const item = this.createNotificationItem(notification);
            container.appendChild(item);
        });
    }

    createNotificationItem(notification) {
        const div = document.createElement('div');
        div.className = `notification-item p-4 border-b hover:bg-gray-50 cursor-pointer ${
            !notification.read_at ? 'bg-blue-50 border-l-4 border-l-blue-500' : ''
        }`;
        div.dataset.id = notification.id;

        const priorityColors = {
            high: 'text-red-600',
            medium: 'text-yellow-600',
            low: 'text-green-600'
        };

        const typeIcons = {
            news: 'fas fa-newspaper',
            complaint: 'fas fa-exclamation-triangle',
            document: 'fas fa-file-alt',
            system: 'fas fa-cog',
            default: 'fas fa-bell'
        };

        div.innerHTML = `
            <div class="flex items-start space-x-3">
                <div class="flex-shrink-0">
                    <i class="${typeIcons[notification.type] || typeIcons.default} ${priorityColors[notification.priority]} text-lg"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-center justify-between">
                        <h4 class="text-sm font-medium text-gray-900 truncate">
                            ${notification.title || 'Notifikasi'}
                        </h4>
                        <span class="text-xs text-gray-500">
                            ${this.formatTimeAgo(notification.created_at)}
                        </span>
                    </div>
                    <p class="text-sm text-gray-600 mt-1">
                        ${notification.message || ''}
                    </p>
                    ${notification.action_url ? `
                        <a href="${notification.action_url}" class="text-xs text-blue-600 hover:text-blue-800 mt-2 inline-block">
                            Lihat Detail →
                        </a>
                    ` : ''}
                </div>
                ${!notification.read_at ? `
                    <div class="flex-shrink-0">
                        <span class="inline-block w-2 h-2 bg-blue-500 rounded-full"></span>
                    </div>
                ` : ''}
            </div>
        `;

        return div;
    }

    async markAsRead(notificationId) {
        try {
            const response = await fetch(`/notifications/${notificationId}/read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json'
                }
            });

            if (response.ok) {
                // Update local state
                const notification = this.notifications.find(n => n.id == notificationId);
                if (notification) {
                    notification.read_at = new Date().toISOString();
                    this.renderNotifications();
                    this.updateUnreadCount();
                }
            }
        } catch (error) {
            console.error('Error marking notification as read:', error);
        }
    }

    async markAllAsRead() {
        try {
            const response = await fetch('/notifications/read-all', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json'
                }
            });

            if (response.ok) {
                // Update local state
                this.notifications.forEach(notification => {
                    notification.read_at = new Date().toISOString();
                });
                this.renderNotifications();
                this.updateUnreadCount();
            }
        } catch (error) {
            console.error('Error marking all notifications as read:', error);
        }
    }

    updateUnreadCount() {
        this.unreadCount = this.notifications.filter(n => !n.read_at).length;
        
        // Update badge in navigation
        const badge = document.getElementById('notification-badge');
        if (badge) {
            if (this.unreadCount > 0) {
                badge.textContent = this.unreadCount > 99 ? '99+' : this.unreadCount;
                badge.classList.remove('hidden');
            } else {
                badge.classList.add('hidden');
            }
        }

        // Update page title
        if (this.unreadCount > 0) {
            document.title = `(${this.unreadCount}) ${document.title.replace(/^\(\d+\) /, '')}`;
        } else {
            document.title = document.title.replace(/^\(\d+\) /, '');
        }
    }

    showToast(notification) {
        // Create toast notification
        const toast = document.createElement('div');
        toast.className = 'fixed top-4 right-4 bg-white border border-gray-200 rounded-lg shadow-lg p-4 max-w-sm z-50 transform translate-x-full transition-transform duration-300';
        
        toast.innerHTML = `
            <div class="flex items-start space-x-3">
                <div class="flex-shrink-0">
                    <i class="fas fa-bell text-blue-500"></i>
                </div>
                <div class="flex-1">
                    <h4 class="text-sm font-medium text-gray-900">
                        ${notification.title || 'Notifikasi Baru'}
                    </h4>
                    <p class="text-sm text-gray-600 mt-1">
                        ${notification.message || ''}
                    </p>
                </div>
                <button class="flex-shrink-0 text-gray-400 hover:text-gray-600" onclick="this.parentElement.parentElement.remove()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;

        document.body.appendChild(toast);

        // Animate in
        setTimeout(() => {
            toast.classList.remove('translate-x-full');
        }, 100);

        // Auto remove after 5 seconds
        setTimeout(() => {
            toast.classList.add('translate-x-full');
            setTimeout(() => {
                if (toast.parentElement) {
                    toast.remove();
                }
            }, 300);
        }, 5000);
    }

    playNotificationSound() {
        // Play notification sound if enabled
        const audio = new Audio('/sounds/notification.mp3');
        audio.volume = 0.3;
        audio.play().catch(() => {
            // Ignore errors if sound can't be played
        });
    }

    formatTimeAgo(dateString) {
        const date = new Date(dateString);
        const now = new Date();
        const diffInSeconds = Math.floor((now - date) / 1000);

        if (diffInSeconds < 60) {
            return 'Baru saja';
        } else if (diffInSeconds < 3600) {
            const minutes = Math.floor(diffInSeconds / 60);
            return `${minutes} menit lalu`;
        } else if (diffInSeconds < 86400) {
            const hours = Math.floor(diffInSeconds / 3600);
            return `${hours} jam lalu`;
        } else {
            const days = Math.floor(diffInSeconds / 86400);
            return `${days} hari lalu`;
        }
    }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    window.notificationManager = new NotificationManager();
});

// Export for use in other scripts
if (typeof module !== 'undefined' && module.exports) {
    module.exports = NotificationManager;
}