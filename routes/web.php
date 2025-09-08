<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DocumentRequestController;
use App\Http\Controllers\LetterRequestController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\TransparencyController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\Admin\DocumentManagementController;
use App\Http\Controllers\Admin\ComplaintController as AdminComplaintController;
use App\Http\Controllers\Admin\TransparencyController as AdminTransparencyController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\NotificationController as AdminNotificationController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Staff\VillageInfoController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/news', [HomeController::class, 'news'])->name('news.index');
Route::get('/news/{id}', [HomeController::class, 'showNews'])->name('news.show');
Route::get('/gallery', [HomeController::class, 'gallery'])->name('gallery');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'sendContact'])->name('contact.send');

// Public document services
Route::get('/services/documents', [DocumentRequestController::class, 'publicForm'])->name('services.documents');
Route::post('/services/documents', [DocumentRequestController::class, 'publicStore'])->name('documents.public.store');
Route::get('/services/track', [DocumentRequestController::class, 'track'])->name('services.track');
Route::post('/services/track', [DocumentRequestController::class, 'track'])->name('services.track.search');

// Public letter services
Route::get('/services/letters', [LetterRequestController::class, 'publicForm'])->name('services.letters');
Route::post('/services/letters', [LetterRequestController::class, 'publicStore'])->name('letters.public.store');

// Public complaint services
Route::get('/services/complaints', [ComplaintController::class, 'publicForm'])->name('services.complaints');
Route::post('/services/complaints', [ComplaintController::class, 'publicStore'])->name('services.complaints.store');
Route::get('/services/complaints/track', [ComplaintController::class, 'track'])->name('complaints.track');
Route::post('/services/complaints/track', [ComplaintController::class, 'track'])->name('complaints.track.search');

// Public transparency portal
Route::prefix('transparency')->name('transparency.')->group(function () {
    Route::get('/', [TransparencyController::class, 'index'])->name('index');
    Route::get('/{transparency}', [TransparencyController::class, 'show'])->name('show');
    Route::get('/{transparency}/download', [TransparencyController::class, 'download'])->name('download');
    Route::get('/budget/overview', [TransparencyController::class, 'budget'])->name('budget');
    Route::get('/procurement/list', [TransparencyController::class, 'procurement'])->name('procurement');
    Route::get('/projects/list', [TransparencyController::class, 'projects'])->name('projects');
    Route::get('/regulations/list', [TransparencyController::class, 'regulations'])->name('regulations');
    Route::get('/reports/list', [TransparencyController::class, 'reports'])->name('reports');
});

// User dashboard (authenticated users)
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/user/dashboard/stats', [UserDashboardController::class, 'getStats'])->name('user.dashboard.stats');
    Route::get('/user/dashboard/activities', [UserDashboardController::class, 'getRecentActivities'])->name('user.dashboard.activities');
    
    // Keep old route for backward compatibility
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Document requests for authenticated users
    Route::resource('documents', DocumentRequestController::class);
    Route::get('/documents-status', [DocumentRequestController::class, 'status'])->name('documents.status');

    // Complaints for authenticated users
    Route::resource('complaints', ComplaintController::class);
    Route::delete('/complaints/{complaint}/attachments', [ComplaintController::class, 'removeAttachment'])->name('complaints.remove-attachment');
});

// Staff dashboard
Route::middleware(['auth', 'role:staff'])->group(function () {
    Route::get('/staff/dashboard', function () {
        return view('staff.dashboard');
    })->name('staff.dashboard');

    // Document management for staff
    Route::prefix('staff/documents')->name('staff.documents.')->group(function () {
        Route::get('/', [DocumentManagementController::class, 'index'])->name('index');
        Route::get('/{document}', [DocumentManagementController::class, 'show'])->name('show');
        Route::put('/{document}/status', [DocumentManagementController::class, 'updateStatus'])->name('updateStatus');
        Route::post('/bulk-update', [DocumentManagementController::class, 'bulkUpdate'])->name('bulk-update');
        Route::get('/export/csv', [DocumentManagementController::class, 'export'])->name('export');
    });

    // Complaint management for staff
    Route::prefix('staff/complaints')->name('staff.complaints.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Staff\StaffComplaintController::class, 'index'])->name('index');
        Route::get('/{complaint}', [\App\Http\Controllers\Staff\StaffComplaintController::class, 'show'])->name('show');
        Route::put('/{complaint}/status', [\App\Http\Controllers\Staff\StaffComplaintController::class, 'updateStatus'])->name('update-status');
        Route::put('/{complaint}/priority', [\App\Http\Controllers\Staff\StaffComplaintController::class, 'updatePriority'])->name('update-priority');
        Route::put('/{complaint}/assign', [\App\Http\Controllers\Staff\StaffComplaintController::class, 'assign'])->name('assign');
        Route::post('/{complaint}/notes', [AdminComplaintController::class, 'saveNotes'])->name('save-notes');
        Route::post('/bulk-update', [AdminComplaintController::class, 'bulkUpdate'])->name('bulk-update');
        Route::get('/export/csv', [AdminComplaintController::class, 'export'])->name('export');
        Route::delete('/{complaint}', [AdminComplaintController::class, 'destroy'])->name('destroy');
    });

    // Village information management for staff
    Route::prefix('staff/village-info')->name('staff.village-info.')->group(function () {
        Route::get('/', [VillageInfoController::class, 'index'])->name('index');
        Route::post('/', [VillageInfoController::class, 'store'])->name('store');
        Route::get('/{id}', [VillageInfoController::class, 'show'])->name('show');
        Route::put('/{id}', [VillageInfoController::class, 'update'])->name('update');
        Route::delete('/{id}', [VillageInfoController::class, 'destroy'])->name('destroy');
        Route::get('/export/csv', [VillageInfoController::class, 'export'])->name('export');
    });

    // Transparency management for staff
    Route::prefix('staff/transparency')->name('staff.transparency.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Staff\StaffTransparencyController::class, 'index'])->name('index');
        Route::get('/create', [\App\Http\Controllers\Staff\StaffTransparencyController::class, 'create'])->name('create');
        Route::post('/', [\App\Http\Controllers\Staff\StaffTransparencyController::class, 'store'])->name('store');
        Route::get('/{transparency}', [\App\Http\Controllers\Staff\StaffTransparencyController::class, 'show'])->name('show');
        Route::get('/{transparency}/edit', [\App\Http\Controllers\Staff\StaffTransparencyController::class, 'edit'])->name('edit');
        Route::put('/{transparency}', [\App\Http\Controllers\Staff\StaffTransparencyController::class, 'update'])->name('update');
        Route::delete('/{transparency}', [\App\Http\Controllers\Staff\StaffTransparencyController::class, 'destroy'])->name('destroy');
        Route::post('/bulk-action', [\App\Http\Controllers\Staff\StaffTransparencyController::class, 'bulkAction'])->name('bulk-action');
        Route::post('/bulk-update', [\App\Http\Controllers\Staff\StaffTransparencyController::class, 'bulkUpdate'])->name('bulk-update');
    });

    Route::put('/staff/village-info/village', [VillageInfoController::class, 'updateVillage'])->name('staff.village-info.village.update');

    // Services management for staff (alias for documents)
    Route::prefix('staff/services')->name('staff.services.')->group(function () {
        Route::get('/', [DocumentManagementController::class, 'index'])->name('index');
        Route::get('/{document}', [DocumentManagementController::class, 'show'])->name('show');
        Route::put('/{document}/status', [DocumentManagementController::class, 'updateStatus'])->name('updateStatus');
        Route::post('/bulk-update', [DocumentManagementController::class, 'bulkUpdate'])->name('bulk-update');
        Route::get('/export/csv', [DocumentManagementController::class, 'export'])->name('export');
    });
});

// Admin dashboard
Route::middleware(['auth', 'role:admin,super-admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Document management for admin
    Route::prefix('admin/documents')->name('admin.documents.')->group(function () {
        Route::get('/', [DocumentManagementController::class, 'index'])->name('index');
        Route::get('/{document}', [DocumentManagementController::class, 'show'])->name('show');
        Route::put('/{document}/status', [DocumentManagementController::class, 'updateStatus'])->name('updateStatus');
        Route::post('/bulk-update', [DocumentManagementController::class, 'bulkUpdate'])->name('bulk-update');
        Route::get('/export/csv', [DocumentManagementController::class, 'export'])->name('export');
    });

    // Letter management for admin
    Route::prefix('admin/letters')->name('admin.letters.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\LetterManagementController::class, 'index'])->name('index');
        Route::get('/{letter}', [\App\Http\Controllers\Admin\LetterManagementController::class, 'show'])->name('show');
        Route::post('/{letter}/status', [\App\Http\Controllers\Admin\LetterManagementController::class, 'updateStatus'])->name('update-status');
        Route::post('/{letter}/assign', [\App\Http\Controllers\Admin\LetterManagementController::class, 'assign'])->name('assign');
        Route::get('/export/csv', [\App\Http\Controllers\Admin\LetterManagementController::class, 'export'])->name('export');
    });

    // Complaint management for admin
    Route::prefix('admin/complaints')->name('admin.complaints.')->group(function () {
        Route::get('/', [AdminComplaintController::class, 'index'])->name('index');
        Route::get('/dashboard', [AdminComplaintController::class, 'dashboard'])->name('dashboard');
        Route::get('/{complaint}', [AdminComplaintController::class, 'show'])->name('show');
        Route::put('/{complaint}/status', [AdminComplaintController::class, 'updateStatus'])->name('update-status');
        Route::put('/{complaint}/priority', [AdminComplaintController::class, 'updatePriority'])->name('update-priority');
        Route::put('/{complaint}/assign', [AdminComplaintController::class, 'assign'])->name('assign');
        Route::post('/{complaint}/notes', [AdminComplaintController::class, 'saveNotes'])->name('save-notes');
        Route::post('/bulk-update', [AdminComplaintController::class, 'bulkUpdate'])->name('bulk-update');
        Route::get('/export/csv', [AdminComplaintController::class, 'export'])->name('export');
        Route::delete('/{complaint}', [AdminComplaintController::class, 'destroy'])->name('destroy');
    });

    // News management for admin
    Route::prefix('admin/news')->name('admin.news.')->group(function () {
        Route::get('/', [AdminNewsController::class, 'index'])->name('index');
        Route::get('/create', [AdminNewsController::class, 'create'])->name('create');
        Route::post('/', [AdminNewsController::class, 'store'])->name('store');
        Route::get('/{news}', [AdminNewsController::class, 'show'])->name('show');
        Route::get('/{news}/edit', [AdminNewsController::class, 'edit'])->name('edit');
        Route::put('/{news}', [AdminNewsController::class, 'update'])->name('update');
        Route::delete('/{news}', [AdminNewsController::class, 'destroy'])->name('destroy');
        Route::post('/{news}/duplicate', [AdminNewsController::class, 'duplicate'])->name('duplicate');
        Route::post('/bulk-update', [AdminNewsController::class, 'bulkUpdate'])->name('bulk-update');
        Route::get('/export/csv', [AdminNewsController::class, 'export'])->name('export');
    });

    // Gallery management for admin
    Route::prefix('admin/gallery')->name('admin.gallery.')->group(function () {
        Route::get('/', [AdminGalleryController::class, 'index'])->name('index');
        Route::get('/create', [AdminGalleryController::class, 'create'])->name('create');
        Route::post('/', [AdminGalleryController::class, 'store'])->name('store');
        Route::get('/{gallery}', [AdminGalleryController::class, 'show'])->name('show');
        Route::get('/{gallery}/edit', [AdminGalleryController::class, 'edit'])->name('edit');
        Route::put('/{gallery}', [AdminGalleryController::class, 'update'])->name('update');
        Route::delete('/{gallery}', [AdminGalleryController::class, 'destroy'])->name('destroy');
        Route::post('/bulk-delete', [AdminGalleryController::class, 'bulkDelete'])->name('bulk-delete');
        Route::post('/{gallery}/toggle-featured', [AdminGalleryController::class, 'toggleFeatured'])->name('toggle-featured');
        Route::get('/export/csv', [AdminGalleryController::class, 'export'])->name('export');
    });

    // Transparency management for admin
    Route::prefix('admin/transparency')->name('admin.transparency.')->group(function () {
        Route::get('/', [AdminTransparencyController::class, 'index'])->name('index');
        Route::get('/create', [AdminTransparencyController::class, 'create'])->name('create');
        Route::post('/', [AdminTransparencyController::class, 'store'])->name('store');
        Route::get('/{transparency}', [AdminTransparencyController::class, 'show'])->name('show');
        Route::get('/{transparency}/edit', [AdminTransparencyController::class, 'edit'])->name('edit');
        Route::put('/{transparency}', [AdminTransparencyController::class, 'update'])->name('update');
        Route::delete('/{transparency}', [AdminTransparencyController::class, 'destroy'])->name('destroy');
        Route::post('/bulk-update', [AdminTransparencyController::class, 'bulkUpdate'])->name('bulk-update');
        Route::get('/export/csv', [AdminTransparencyController::class, 'export'])->name('export');
    });

    // Document requests management for admin
    Route::prefix('admin/document-requests')->name('admin.document-requests.')->group(function () {
        Route::get('/', [DocumentManagementController::class, 'index'])->name('index');
        Route::get('/{documentRequest}', [DocumentManagementController::class, 'show'])->name('show');
        Route::put('/{documentRequest}/status', [DocumentManagementController::class, 'updateStatus'])->name('updateStatus');
        Route::put('/{documentRequest}/assign', [DocumentManagementController::class, 'assign'])->name('assign');
        Route::post('/{documentRequest}/notes', [DocumentManagementController::class, 'saveNotes'])->name('save-notes');
        Route::delete('/{documentRequest}', [DocumentManagementController::class, 'destroy'])->name('destroy');
        Route::get('/export/csv', [DocumentManagementController::class, 'export'])->name('export');
    });

    // User management for admin
    Route::prefix('admin/users')->name('admin.users.')->group(function () {
        Route::get('/', [AdminUserController::class, 'index'])->name('index');
        Route::get('/create', [AdminUserController::class, 'create'])->name('create');
        Route::post('/', [AdminUserController::class, 'store'])->name('store');
        Route::get('/{user}', [AdminUserController::class, 'show'])->name('show');
        Route::get('/{user}/edit', [AdminUserController::class, 'edit'])->name('edit');
        Route::put('/{user}', [AdminUserController::class, 'update'])->name('update');
        Route::delete('/{user}', [AdminUserController::class, 'destroy'])->name('destroy');
        Route::post('/{user}/toggle-status', [AdminUserController::class, 'toggleStatus'])->name('toggle-status');
        Route::get('/export/csv', [AdminUserController::class, 'export'])->name('export');
    });

    // Notification management for admin
    Route::prefix('admin/notifications')->name('admin.notifications.')->group(function () {
        Route::get('/', [AdminNotificationController::class, 'index'])->name('index');
        Route::get('/api', [AdminNotificationController::class, 'getNotifications'])->name('api');
        Route::post('/{id}/read', [AdminNotificationController::class, 'markAsRead'])->name('read');
        Route::post('/read-all', [AdminNotificationController::class, 'markAllAsRead'])->name('read-all');
        Route::delete('/{id}', [AdminNotificationController::class, 'destroy'])->name('destroy');
        Route::post('/send-test', [AdminNotificationController::class, 'sendTest'])->name('send-test');
        Route::get('/stats', [AdminNotificationController::class, 'getStats'])->name('stats');
        Route::post('/clean-old', [AdminNotificationController::class, 'cleanOld'])->name('clean-old');
    });
});

// Profile routes (Laravel Breeze standard)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/password', [ProfileController::class, 'updatePassword'])->name('password.update');
    
    // User notifications API
    Route::get('/notifications/api', [AdminNotificationController::class, 'getNotifications'])->name('notifications.api');
    Route::post('/notifications/{id}/read', [AdminNotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [AdminNotificationController::class, 'markAllAsRead'])->name('notifications.read-all');
});

// Storage link route for development
Route::get('/generate', function() {
    \Illuminate\Support\Facades\Artisan::call('storage:link');
    echo 'Storage link created successfully!';
});

// Include authentication routes
require __DIR__ . '/auth.php';
