<?php

namespace App\Helpers;

class RoleHelper
{
    const ADMIN = 'Admin';
    const CS = 'CS';
    const NOC = 'NOC';

    /**
     * Get all available roles
     */
    public static function getAllRoles(): array
    {
        return [
            self::ADMIN => 'Administrator',
            self::CS => 'Customer Service',
            self::NOC => 'NOC Agent',
        ];
    }

    /**
     * Get role hierarchy (higher number = higher priority)
     */
    public static function getRoleHierarchy(): array
    {
        return [
            self::CS => 1,
            self::NOC => 2,
            self::ADMIN => 3,
        ];
    }

    /**
     * Check if user has specific role
     */
    public static function hasRole($user, string $role): bool
    {
        return $user->role === $role;
    }

    /**
     * Check if user has any of the specified roles
     */
    public static function hasAnyRole($user, array $roles): bool
    {
        return in_array($user->role, $roles);
    }

    /**
     * Check if user has higher or equal role than specified role
     */
    public static function hasMinimumRole($user, string $minimumRole): bool
    {
        $hierarchy = self::getRoleHierarchy();
        return ($hierarchy[$user->role] ?? 0) >= ($hierarchy[$minimumRole] ?? 0);
    }

    /**
     * Get role display name
     */
    public static function getRoleDisplayName(string $role): string
    {
        return self::getAllRoles()[$role] ?? $role;
    }

    /**
     * Customer Service Permissions
     */
    public static function canCS($action): bool
    {
        $csPermissions = [
            'create-customers' => true,
            'create-tickets' => true,
            'view-customers' => true,
            'view-own-tickets' => true,
            'edit-customers' => true,
        ];

        return $csPermissions[$action] ?? false;
    }

    /**
     * NOC Agent Permissions
     */
    public static function canNOC($action): bool
    {
        $nocPermissions = [
            'view-all-tickets' => true,
            'update-ticket-status' => true,
            'assign-tickets' => true,
            'view-customers' => true,
            'view-ticket-logs' => true,
            'create-tickets' => true,
        ];

        return $nocPermissions[$action] ?? false;
    }

    /**
     * Admin Permissions (full access)
     */
    public static function canAdmin($action): bool
    {
        return true; // Admin has all permissions
    }

    /**
     * Check if user can perform specific action
     */
    public static function can($user, string $action): bool
    {
        switch ($user->role) {
            case self::ADMIN:
                return self::canAdmin($action);
            case self::CS:
                return self::canCS($action);
            case self::NOC:
                return self::canNOC($action);
            default:
                return false;
        }
    }

    /**
     * Get role-specific dashboard data
     */
    public static function getDashboardData($user): array
    {
        switch ($user->role) {
            case self::CS:
                return [
                    'title' => 'Dashboard Customer Service',
                    'description' => 'Kelola pelanggan dan buat tiket gangguan',
                    'stats' => ['customers_today', 'tickets_created', 'pending_tickets']
                ];
            case self::NOC:
                return [
                    'title' => 'Dashboard NOC Agent',
                    'description' => 'Pantau dan proses tiket gangguan',
                    'stats' => ['active_tickets', 'resolved_today', 'critical_tickets', 'avg_resolution_time']
                ];
            case self::ADMIN:
                return [
                    'title' => 'Dashboard Administrator',
                    'description' => 'Pantau keseluruhan operasional sistem',
                    'stats' => ['total_tickets', 'total_customers', 'total_users', 'system_health']
                ];
            default:
                return [
                    'title' => 'Dashboard',
                    'description' => 'Selamat datang di sistem',
                    'stats' => []
                ];
        }
    }
}