        <aside id="sidebar"
            class="fixed inset-y-0 left-0 z-50 w-64 bg-white dark:bg-zinc-900 border-r border-zinc-200/60 dark:border-zinc-800/60 transform -translate-x-full transition-transform duration-300 ease-in-out lg:translate-x-0">
            <div class="flex flex-col h-full">
                <!-- Logo -->
                <div class="flex items-center justify-between h-14 px-5 border-b border-zinc-200/60 dark:border-zinc-800/60">
                    @if (isset($settings) && $settings->logo_type === 'image' && $settings->app_logo)
                        <img src="{{ \App\Services\FileUploadService::getFileUrl($settings->app_logo) }}"
                            alt="{{ $settings->app_name }}" class="h-10 max-w-full object-contain">
                    @else
                        <h1 class="text-lg font-semibold text-zinc-900 dark:text-white tracking-tight">
                            {{ isset($settings) && $settings->logo_text ? $settings->logo_text : (isset($settings) ? $settings->app_name : 'InForge') }}
                        </h1>
                    @endif
                    <button id="closeSidebar"
                        class="lg:hidden text-zinc-500 hover:text-zinc-700 dark:text-zinc-400 dark:hover:text-zinc-200 transition-colors">
                        <x-heroicon-o-x-mark class="w-6 h-6" />
                    </button>
                </div>

                <!-- Navigation -->
                <nav id="sidebarNav" class="flex-1 px-3 py-4 space-y-4 overflow-y-auto">
                    @if (isset($groupedMenus))
                        @foreach ($groupedMenus as $sectionTitle => $menus)
                            <div class="space-y-1">
                                @if ($sectionTitle)
                                    <h3 class="px-3 py-2 text-[10px] uppercase font-bold text-zinc-400 dark:text-zinc-500 tracking-wider">
                                        {{ $sectionTitle }}
                                    </h3>
                                @endif
                                <div class="space-y-0.5">
                                    @foreach ($menus as $menu)
                                        <x-admin.menu-item :menu="$menu" />
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    @elseif (isset($menus))
                        <div class="space-y-0.5">
                            @foreach ($menus as $menu)
                                <x-admin.menu-item :menu="$menu" />
                            @endforeach
                        </div>
                    @endif
                </nav>

                <!-- User Section -->
                <div class="p-4 border-t border-zinc-200/60 dark:border-zinc-800/60">
                    <a href="{{ route('admin.profile.index') }}" class="flex items-center p-2 -mx-2 rounded-xl hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors">
                        @if(Auth::user()->avatar)
                            <img class="w-10 h-10 rounded-full object-cover"
                                src="{{ Storage::url(Auth::user()->avatar) }}"
                                alt="User">
                        @else
                            <img class="w-10 h-10 rounded-full"
                                src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=3b82f6&color=fff"
                                alt="User">
                        @endif
                        <div class="ml-3">
                            <p class="text-sm font-bold text-zinc-900 dark:text-white">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-zinc-500 dark:text-zinc-400 truncate w-32">{{ Auth::user()->email }}</p>
                        </div>
                    </a>
                </div>
            </div>
        </aside>

        <!-- Sidebar spacer for desktop -->
        <div id="sidebarSpacer" class="hidden lg:block w-64 flex-shrink-0 transition-all duration-300 ease-in-out">
        </div>
