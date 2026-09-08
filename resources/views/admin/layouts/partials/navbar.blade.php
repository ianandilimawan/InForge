<header class="bg-white/80 dark:bg-zinc-900/80 backdrop-blur-md border-b border-zinc-100 dark:border-zinc-800/80 z-30 transition-all flex-shrink-0">
    <div class="flex items-center h-16 px-4 sm:px-6 justify-between">
        <!-- Left: Sidebar Toggle Button & Workspace Title -->
        <div class="flex items-center gap-3">
            <!-- Desktop Only: Sidebar Toggle Button -->
            <button id="toggleSidebar"
                class="hidden lg:inline-flex p-2 rounded-xl text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white bg-zinc-100/80 dark:bg-zinc-800/80 hover:bg-zinc-200/80 dark:hover:bg-zinc-700/80 border border-zinc-200/60 dark:border-zinc-700/60 focus:outline-none transition-all cursor-pointer"
                title="Toggle Sidebar">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                </svg>
            </button>

            <!-- Mobile Only: Toggle Sidebar Button -->
            <button id="toggleMobileSidebar" onclick="document.getElementById('sidebar').classList.remove('-translate-x-full'); document.getElementById('sidebarOverlay').classList.remove('hidden');"
                class="lg:hidden p-2 rounded-xl text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white bg-zinc-100/80 dark:bg-zinc-800/80 border border-zinc-200/60 dark:border-zinc-700/60 focus:outline-none">
                <x-heroicon-o-bars-3 class="w-5 h-5" />
            </button>

        </div>

        <!-- Right: Utility Actions -->
        <div class="flex items-center space-x-2 sm:space-x-3">

            <!-- Notifications -->
            <div class="relative" x-data="{ open: false }" @click.outside="open = false">
                <button @click="open = !open"
                    class="relative p-2 rounded-xl text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white bg-zinc-100/80 dark:bg-zinc-800/80 border border-zinc-200/60 dark:border-zinc-700/60 hover:border-zinc-300 dark:hover:border-zinc-600 transition-all cursor-pointer">
                    <x-heroicon-o-bell class="w-4 h-4" />
                    <span class="absolute top-1.5 right-1.5 flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                    </span>
                </button>

                <!-- Dropdown Menu -->
                <div x-show="open" 
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    style="display: none;"
                    class="absolute right-0 mt-2 w-80 bg-white dark:bg-zinc-900 rounded-2xl shadow-xl py-1 border border-zinc-200/80 dark:border-zinc-800 z-50">
                    <div class="px-4 py-3 border-b border-zinc-100 dark:border-zinc-800 flex justify-between items-center">
                        <h3 class="text-xs font-bold text-zinc-900 dark:text-white uppercase tracking-wider">Notifications</h3>
                        <span class="bg-emerald-50 text-emerald-700 dark:bg-emerald-950/80 dark:text-emerald-300 text-[10px] font-bold px-2 py-0.5 rounded-full border border-emerald-200/50">3 New</span>
                    </div>
                    <div class="max-h-80 overflow-y-auto divide-y divide-zinc-100 dark:divide-zinc-800">
                        <div class="p-3 hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition flex gap-3">
                            <div class="w-8 h-8 rounded-xl bg-emerald-100 dark:bg-emerald-900/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0">
                                <x-heroicon-o-user class="w-4 h-4" />
                            </div>
                            <div class="text-xs">
                                <p class="font-bold text-zinc-900 dark:text-white">New User Registered</p>
                                <p class="text-zinc-500 dark:text-zinc-400 text-[11px]">A new user account was created.</p>
                                <p class="text-emerald-600 dark:text-emerald-400 text-[10px] font-medium mt-1">2 minutes ago</p>
                            </div>
                        </div>
                        <div class="p-3 hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition flex gap-3">
                            <div class="w-8 h-8 rounded-xl bg-blue-100 dark:bg-blue-900/60 text-blue-600 dark:text-blue-400 flex items-center justify-center shrink-0">
                                <x-heroicon-o-check-circle class="w-4 h-4" />
                            </div>
                            <div class="text-xs">
                                <p class="font-bold text-zinc-900 dark:text-white">System Normal</p>
                                <p class="text-zinc-500 dark:text-zinc-400 text-[11px]">Automated database backup completed.</p>
                                <p class="text-blue-600 dark:text-blue-400 text-[10px] font-medium mt-1">1 hour ago</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dark Mode Toggle -->
            <button id="themeToggle"
                class="p-2 text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white bg-zinc-100/80 dark:bg-zinc-800/80 border border-zinc-200/60 dark:border-zinc-700/60 hover:border-zinc-300 dark:hover:border-zinc-600 rounded-xl transition-all cursor-pointer"
                title="Toggle Theme Mode">
                <x-heroicon-s-sun id="sunIcon" class="w-4 h-4" style="display: block;" />
                <x-heroicon-s-moon id="moonIcon" class="w-4 h-4" style="display: none;" />
            </button>

            <!-- Desktop Logout Button -->
            <form method="POST" action="{{ route('admin.logout') }}" class="hidden sm:inline">
                @csrf
                <button type="submit"
                    class="px-3 py-1.5 text-xs font-bold text-rose-600 dark:text-rose-400 hover:text-rose-700 dark:hover:text-rose-300 bg-rose-50 dark:bg-rose-950/60 hover:bg-rose-100 dark:hover:bg-rose-900/60 border border-rose-200/60 dark:border-rose-800/60 rounded-xl transition-all cursor-pointer shadow-2xs">
                    Logout
                </button>
            </form>
        </div>
    </div>
</header>
