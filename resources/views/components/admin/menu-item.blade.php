@props(['menu'])

@php
    $url = '#';
    $routeName = $menu['route'] ?? null;
    $menuUrl = $menu['url'] ?? null;
    $menuSlug = $menu['slug'] ?? null;
    $menuIcon = $menu['icon'] ?? '';
    $menuName = $menu['name'] ?? 'Untitled';

    if ($routeName) {
        // Check if route exists
        if (Route::has($routeName)) {
            // Check if menu has slug/parameter for dynamic routes
            if (!empty($menuSlug)) {
                try {
                    // Try to get route parameters from Laravel route definition
                    $route = app('router')->getRoutes()->getByName($routeName);
                    $parameterNames = $route ? $route->parameterNames() : [];

                    // If route has parameters, use the first one with menu slug value
                    if (!empty($parameterNames)) {
                        $params = [$parameterNames[0] => $menuSlug];
                        $url = route($routeName, $params);
                    } else {
                        // Route doesn't have parameters, use without parameter
                    $url = route($routeName);
                }
            } catch (\Exception $e) {
                // If route doesn't accept parameter, use without parameter
                    $url = route($routeName);
                }
            } else {
                $url = route($routeName);
            }
        } else {
            // Route doesn't exist yet
        $url = 'javascript:void(0)';
    }
} elseif ($menuUrl) {
    $url = $menuUrl;
}

// Check if current route is active
$isActive = false;
if ($routeName && Route::has($routeName)) {
    if (!empty($menuSlug)) {
        // Get current route parameters
        $currentParams = request()->route() ? request()->route()->parameters() : [];
        $routeMatches = request()->routeIs($routeName);

        // Check if any parameter matches the menu slug
        $paramMatches = in_array($menuSlug, $currentParams);

        $isActive = $routeMatches && $paramMatches;
    } else {
        // Support wildcard matching if route ends with .index, e.g., admin.users.index matches admin.users.*
        $matchPattern = $routeName;
        if (str_ends_with($routeName, '.index')) {
            $matchPattern = str_replace('.index', '.*', $routeName);
            }
            $isActive = request()->routeIs($routeName) || request()->routeIs($matchPattern);
        }
    }
@endphp

<a href="{{ $url }}"
    class="group flex items-center gap-2.5 px-2.5 py-2 text-[13px] rounded-xl transition-all cursor-pointer {{ $isActive ? 'bg-blue-50 dark:bg-blue-950/60 text-blue-700 dark:text-blue-300 font-semibold' : 'font-medium text-zinc-600 dark:text-zinc-400 hover:bg-zinc-50 dark:hover:bg-zinc-800/50' }}">
    <div class="w-7 h-7 rounded-lg flex items-center justify-center shrink-0 transition-colors {{ $isActive ? 'bg-blue-100 dark:bg-blue-900/60' : 'bg-zinc-100 dark:bg-zinc-800' }}">
        {!! App\Helpers\MenuHelper::renderIcon($menuIcon) !!}
    </div>
    <span class="truncate">{{ $menuName }}</span>
</a>
