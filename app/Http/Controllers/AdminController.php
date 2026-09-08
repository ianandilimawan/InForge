<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ActivityLog;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $userGrowthTrends = [];
        for ($i = 5; $i >= 0; $i--) {
            $d = now()->subMonths($i);
            $m = (int) $d->format('m');
            $y = (int) $d->format('Y');
            $count = User::whereMonth('created_at', $m)
                ->whereYear('created_at', $y)
                ->count();
            $userGrowthTrends[] = [
                'month_name' => $d->translatedFormat('M Y'),
                'new_users' => $count,
            ];
        }

        $systemStats = [
            'total_users' => User::count(),
            'new_users_this_month' => User::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count(),
            'new_users_this_week' => User::where('created_at', '>=', now()->subDays(7))->count(),
            'user_growth_trends' => $userGrowthTrends,
            'total_roles' => class_exists(Role::class) ? Role::count() : 0,
            'total_permissions' => class_exists(Permission::class) ? Permission::count() : 0,
            'total_activities' => class_exists(ActivityLog::class) ? ActivityLog::count() : 0,
            'recent_users' => User::with('roles')->latest()->take(5)->get(),
            'recent_activities' => class_exists(ActivityLog::class) ? ActivityLog::with('user')->latest()->take(6)->get() : collect(),
            'server_info' => [
                'php_version' => PHP_VERSION,
                'laravel_version' => app()->version(),
                'environment' => app()->environment(),
                'db_driver' => config('database.default'),
                'cache_driver' => config('cache.default'),
                'queue_driver' => config('queue.default'),
            ],
        ];

        return view('admin.pages.dashboard', compact('systemStats'));
    }
}
