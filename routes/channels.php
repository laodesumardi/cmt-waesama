<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

// Private channel for user notifications
Broadcast::channel('user.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// Private channel for admin notifications
Broadcast::channel('admin.notifications', function ($user) {
    return $user->hasRole(['admin', 'super-admin']);
});

// Private channel for staff notifications
Broadcast::channel('staff.notifications', function ($user) {
    return $user->hasRole(['staff', 'admin', 'super-admin']);
});

// Private channel for document requests
Broadcast::channel('document-requests', function ($user) {
    return $user->hasRole(['staff', 'admin', 'super-admin']);
});

// Private channel for letter requests
Broadcast::channel('letter-requests', function ($user) {
    return $user->hasRole(['staff', 'admin', 'super-admin']);
});

// Private channel for complaints
Broadcast::channel('complaints', function ($user) {
    return $user->hasRole(['staff', 'admin', 'super-admin']);
});