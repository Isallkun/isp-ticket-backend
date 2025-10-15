<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Helpers\RoleHelper;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Check if user has the required permission
        if (!RoleHelper::can($user, $permission)) {
            // For API requests, return JSON response
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Unauthorized. Required permission: ' . $permission,
                    'user_role' => $user->role,
                    'required_permission' => $permission
                ], 403);
            }

            // For web requests, redirect with error message
            return redirect()->route('home')
                ->with('error', 'Anda tidak memiliki izin untuk melakukan tindakan ini.');
        }

        return $next($request);
    }
}
