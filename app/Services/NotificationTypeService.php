<?php

namespace App\Services;

class NotificationTypeService
{
    /**
     * Get notification type configuration
     *
     * @param string $category
     * @param string $action
     * @return array|null
     */
    public static function getType(string $category, string $action): ?array
    {
        $types = config('notification_types');
        
        return $types[$category][$action] ?? null;
    }

    /**
     * Get all notification types for a category
     *
     * @param string $category
     * @return array
     */
    public static function getCategory(string $category): array
    {
        $types = config('notification_types');
        
        return $types[$category] ?? [];
    }

    /**
     * Get priority configuration
     *
     * @param string $priority
     * @return array|null
     */
    public static function getPriority(string $priority): ?array
    {
        $priorities = config('notification_types.priorities');
        
        return $priorities[$priority] ?? null;
    }

    /**
     * Get channel configuration
     *
     * @param string $channel
     * @return array|null
     */
    public static function getChannel(string $channel): ?array
    {
        $channels = config('notification_types.channels');
        
        return $channels[$channel] ?? null;
    }

    /**
     * Check if a channel is enabled
     *
     * @param string $channel
     * @return bool
     */
    public static function isChannelEnabled(string $channel): bool
    {
        $channelConfig = self::getChannel($channel);
        
        return $channelConfig['enabled'] ?? false;
    }

    /**
     * Get notification icon for a type
     *
     * @param string $category
     * @param string $action
     * @return string
     */
    public static function getIcon(string $category, string $action): string
    {
        $type = self::getType($category, $action);
        
        return $type['icon'] ?? 'fas fa-bell';
    }

    /**
     * Get notification priority for a type
     *
     * @param string $category
     * @param string $action
     * @return string
     */
    public static function getTypePriority(string $category, string $action): string
    {
        $type = self::getType($category, $action);
        
        return $type['priority'] ?? 'medium';
    }

    /**
     * Get target roles for a notification type
     *
     * @param string $category
     * @param string $action
     * @return array
     */
    public static function getTargetRoles(string $category, string $action): array
    {
        $type = self::getType($category, $action);
        
        return $type['target_roles'] ?? [];
    }

    /**
     * Check if email should be sent for a notification type
     *
     * @param string $category
     * @param string $action
     * @return bool
     */
    public static function shouldSendEmail(string $category, string $action): bool
    {
        $type = self::getType($category, $action);
        
        return ($type['email'] ?? false) && self::isChannelEnabled('email');
    }

    /**
     * Get notification channels for a type
     *
     * @param string $category
     * @param string $action
     * @return array
     */
    public static function getChannels(string $category, string $action): array
    {
        $type = self::getType($category, $action);
        $channels = $type['channels'] ?? ['database'];
        
        // Filter out disabled channels
        return array_filter($channels, function($channel) {
            return self::isChannelEnabled($channel);
        });
    }

    /**
     * Get priority color
     *
     * @param string $priority
     * @return string
     */
    public static function getPriorityColor(string $priority): string
    {
        $priorityConfig = self::getPriority($priority);
        
        return $priorityConfig['color'] ?? 'gray';
    }

    /**
     * Check if sound should be played for priority
     *
     * @param string $priority
     * @return bool
     */
    public static function shouldPlaySound(string $priority): bool
    {
        $priorityConfig = self::getPriority($priority);
        
        return $priorityConfig['sound'] ?? false;
    }

    /**
     * Get all available categories
     *
     * @return array
     */
    public static function getCategories(): array
    {
        $types = config('notification_types');
        
        return array_keys(array_filter($types, function($key) {
            return !in_array($key, ['priorities', 'channels']);
        }, ARRAY_FILTER_USE_KEY));
    }

    /**
     * Get notification type string
     *
     * @param string $category
     * @param string $action
     * @return string
     */
    public static function getTypeString(string $category, string $action): string
    {
        $type = self::getType($category, $action);
        
        return $type['type'] ?? "{$category}_{$action}";
    }

    /**
     * Validate if notification type exists
     *
     * @param string $category
     * @param string $action
     * @return bool
     */
    public static function exists(string $category, string $action): bool
    {
        return self::getType($category, $action) !== null;
    }

    /**
     * Get notification settings for a specific role
     *
     * @param string $category
     * @param string $action
     * @param string $role
     * @return array|null
     */
    public static function getSettingsForRole(string $category, string $action, string $role): ?array
    {
        $type = self::getType($category, $action);
        
        if (!$type || !in_array($role, $type['target_roles'])) {
            return null;
        }
        
        return [
            'type' => $type['type'],
            'priority' => $type['priority'],
            'channels' => self::getChannels($category, $action),
            'email' => self::shouldSendEmail($category, $action),
            'icon' => $type['icon'],
            'sound' => self::shouldPlaySound($type['priority']),
            'color' => self::getPriorityColor($type['priority']),
        ];
    }
}