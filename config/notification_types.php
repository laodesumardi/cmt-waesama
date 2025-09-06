<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Notification Types Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains the configuration for different notification types
    | used throughout the application. Each type defines the default settings
    | for priority, channels, and target roles.
    |
    */

    'news' => [
        'created' => [
            'type' => 'news_created',
            'priority' => 'low',
            'channels' => ['database', 'broadcast'],
            'target_roles' => ['admin', 'staff'],
            'email' => false,
            'icon' => 'fas fa-newspaper',
        ],
        'updated' => [
            'type' => 'news_updated',
            'priority' => 'low',
            'channels' => ['database', 'broadcast'],
            'target_roles' => ['admin', 'staff'],
            'email' => false,
            'icon' => 'fas fa-edit',
        ],
        'published' => [
            'type' => 'news_published',
            'priority' => 'medium',
            'channels' => ['database', 'broadcast'],
            'target_roles' => ['admin', 'staff', 'user'],
            'email' => false,
            'icon' => 'fas fa-globe',
        ],
    ],

    'gallery' => [
        'created' => [
            'type' => 'gallery_created',
            'priority' => 'low',
            'channels' => ['database', 'broadcast'],
            'target_roles' => ['admin', 'staff'],
            'email' => false,
            'icon' => 'fas fa-images',
        ],
        'featured' => [
            'type' => 'featured_gallery_created',
            'priority' => 'medium',
            'channels' => ['database', 'broadcast'],
            'target_roles' => ['admin', 'staff'],
            'email' => false,
            'icon' => 'fas fa-star',
        ],
    ],

    'transparency' => [
        'created' => [
            'type' => 'transparency_created',
            'priority' => 'medium',
            'channels' => ['database', 'broadcast'],
            'target_roles' => ['admin', 'staff'],
            'email' => false,
            'icon' => 'fas fa-eye',
        ],
        'status_updated' => [
            'type' => 'transparency_status_updated',
            'priority' => 'medium',
            'channels' => ['database', 'broadcast'],
            'target_roles' => ['admin', 'staff'],
            'email' => false,
            'icon' => 'fas fa-sync-alt',
        ],
        'published' => [
            'type' => 'transparency_published',
            'priority' => 'medium',
            'channels' => ['database', 'broadcast'],
            'target_roles' => ['admin', 'staff'],
            'email' => false,
            'icon' => 'fas fa-globe',
        ],
    ],

    'document_request' => [
        'created' => [
            'type' => 'document_request_created',
            'priority' => 'high',
            'channels' => ['database', 'broadcast', 'email'],
            'target_roles' => ['admin', 'staff'],
            'email' => true,
            'icon' => 'fas fa-file-alt',
        ],
        'submitted' => [
            'type' => 'document_request_submitted',
            'priority' => 'medium',
            'channels' => ['database', 'broadcast', 'email'],
            'target_roles' => ['user'],
            'email' => true,
            'icon' => 'fas fa-check-circle',
        ],
        'status_updated' => [
            'type' => 'document_request_status_updated',
            'priority' => 'medium',
            'channels' => ['database', 'broadcast', 'email'],
            'target_roles' => ['user'],
            'email' => true,
            'icon' => 'fas fa-sync-alt',
        ],
        'status_updated_admin' => [
            'type' => 'document_request_status_updated_admin',
            'priority' => 'medium',
            'channels' => ['database', 'broadcast'],
            'target_roles' => ['admin', 'staff'],
            'email' => false,
            'icon' => 'fas fa-sync-alt',
        ],
        'ready' => [
            'type' => 'document_ready_notification',
            'priority' => 'high',
            'channels' => ['database', 'broadcast', 'email'],
            'target_roles' => ['user'],
            'email' => true,
            'icon' => 'fas fa-check-circle',
        ],
        'completed' => [
            'type' => 'document_request_completed',
            'priority' => 'low',
            'channels' => ['database', 'broadcast'],
            'target_roles' => ['admin', 'staff'],
            'email' => false,
            'icon' => 'fas fa-check-circle',
        ],
    ],

    'complaint' => [
        'created' => [
            'type' => 'complaint_created',
            'priority' => 'high',
            'channels' => ['database', 'broadcast', 'email'],
            'target_roles' => ['admin', 'staff'],
            'email' => true,
            'icon' => 'fas fa-exclamation-triangle',
        ],
        'status_updated' => [
            'type' => 'complaint_status_updated',
            'priority' => 'medium',
            'channels' => ['database', 'broadcast', 'email'],
            'target_roles' => ['user'],
            'email' => true,
            'icon' => 'fas fa-sync-alt',
        ],
        'status_updated_admin' => [
            'type' => 'complaint_status_updated_admin',
            'priority' => 'medium',
            'channels' => ['database', 'broadcast'],
            'target_roles' => ['admin', 'staff'],
            'email' => false,
            'icon' => 'fas fa-sync-alt',
        ],
        'resolved' => [
            'type' => 'complaint_resolved',
            'priority' => 'medium',
            'channels' => ['database', 'broadcast', 'email'],
            'target_roles' => ['user'],
            'email' => true,
            'icon' => 'fas fa-check-circle',
        ],
        'assigned' => [
            'type' => 'complaint_assigned',
            'priority' => 'medium',
            'channels' => ['database', 'broadcast'],
            'target_roles' => ['admin', 'staff'],
            'email' => false,
            'icon' => 'fas fa-user-tag',
        ],
    ],

    'system' => [
        'maintenance' => [
            'type' => 'system_maintenance',
            'priority' => 'urgent',
            'channels' => ['database', 'broadcast', 'email'],
            'target_roles' => ['admin', 'staff', 'user'],
            'email' => true,
            'icon' => 'fas fa-tools',
        ],
        'update' => [
            'type' => 'system_update',
            'priority' => 'medium',
            'channels' => ['database', 'broadcast'],
            'target_roles' => ['admin', 'staff'],
            'email' => false,
            'icon' => 'fas fa-sync',
        ],
        'backup' => [
            'type' => 'system_backup',
            'priority' => 'low',
            'channels' => ['database'],
            'target_roles' => ['admin'],
            'email' => false,
            'icon' => 'fas fa-database',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Priority Levels
    |--------------------------------------------------------------------------
    |
    | Available priority levels for notifications:
    | - urgent: Critical notifications that require immediate attention
    | - high: Important notifications that should be addressed soon
    | - medium: Standard notifications
    | - low: Informational notifications
    |
    */
    'priorities' => [
        'urgent' => [
            'label' => 'Urgent',
            'color' => 'red',
            'sound' => true,
        ],
        'high' => [
            'label' => 'High',
            'color' => 'orange',
            'sound' => true,
        ],
        'medium' => [
            'label' => 'Medium',
            'color' => 'blue',
            'sound' => false,
        ],
        'medium' => [
            'label' => 'Medium',
            'color' => 'yellow',
            'sound' => false,
        ],
        'low' => [
            'label' => 'Low',
            'color' => 'gray',
            'sound' => false,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Notification Channels
    |--------------------------------------------------------------------------
    |
    | Available channels for sending notifications:
    | - database: Store in database for web interface
    | - broadcast: Real-time broadcasting via WebSockets
    | - email: Send via email
    | - sms: Send via SMS (if configured)
    |
    */
    'channels' => [
        'database' => [
            'enabled' => true,
            'retention_days' => 30,
        ],
        'broadcast' => [
            'enabled' => true,
            'driver' => 'pusher',
        ],
        'email' => [
            'enabled' => true,
            'queue' => true,
        ],
        'sms' => [
            'enabled' => false,
            'driver' => null,
        ],
    ],
];