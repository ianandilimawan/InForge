@extends('admin.layouts.app')

@section('page-title', 'Dashboard')

@push('styles')
<style>
    /* ApexCharts Theme Text Styling */
    .apexcharts-canvas text,
    .apexcharts-text,
    .apexcharts-legend-text {
        fill: #52525b !important;
        color: #52525b !important;
    }
    .dark .apexcharts-canvas text,
    .dark .apexcharts-text,
    .dark .apexcharts-legend-text {
        fill: #a1a1aa !important;
        color: #a1a1aa !important;
    }
    .apexcharts-grid line {
        stroke: #f4f4f5 !important;
    }
    .dark .apexcharts-grid line {
        stroke: #27272a !important;
    }
</style>
@endpush

@section('content')
<div class="space-y-4 sm:space-y-5 pb-6">

    <!-- Header & Shortcuts -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div>
            <div class="flex items-center gap-2 flex-wrap">
                <h1 class="text-base sm:text-lg md:text-xl font-bold tracking-tight text-zinc-900 dark:text-white">
                    Dashboard Overview
                </h1>
                <span class="text-[10px] sm:text-xs px-2 py-0.5 rounded-full bg-emerald-100 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-300 font-bold border border-emerald-200 dark:border-emerald-800">
                    Sistem & Platform
                </span>
            </div>
            <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">Pantau pertumbuhan pengguna, log aktivitas sistem, status server, dan kontrol platform.</p>
        </div>
        <div class="flex items-center gap-2 flex-wrap">
            <a href="{{ route('admin.users.index') }}"
                class="inline-flex items-center gap-1.5 px-3.5 py-2 text-xs font-bold rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white transition shadow-sm shadow-emerald-600/20">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                <span>Kelola Pengguna</span>
            </a>
            <a href="{{ route('admin.settings.index') }}"
                class="inline-flex items-center gap-1.5 px-3 py-2 text-xs font-semibold rounded-xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 hover:bg-zinc-50 dark:hover:bg-zinc-700 text-zinc-700 dark:text-zinc-200 transition shadow-2xs">
                <svg class="w-3.5 h-3.5 text-zinc-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                <span>Pengaturan</span>
            </a>
            <a href="{{ route('admin.laravel-logs.index') }}"
                class="inline-flex items-center gap-1.5 px-3 py-2 text-xs font-semibold rounded-xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 hover:bg-zinc-50 dark:hover:bg-zinc-700 text-zinc-700 dark:text-zinc-200 transition shadow-2xs">
                <svg class="w-3.5 h-3.5 text-zinc-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                <span>Log Server</span>
            </a>
        </div>
    </div>

    <!-- 4 Platform Metric Summary Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
        <!-- Card 1: Total Users -->
        <div class="p-4 sm:p-5 rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200/80 dark:border-zinc-800 shadow-xs relative overflow-hidden group hover:border-zinc-300 dark:hover:border-zinc-700 transition">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 rounded-xl bg-indigo-50 dark:bg-indigo-950/60 text-indigo-600 dark:text-indigo-400 flex items-center justify-center shadow-xs">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <span class="inline-flex items-center gap-1 text-[11px] font-bold px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 dark:bg-emerald-950/80 dark:text-emerald-300 border border-emerald-200/50">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    {{ $systemStats['total_users'] }} Aktif
                </span>
            </div>
            <div class="text-2xl sm:text-3xl font-black text-zinc-900 dark:text-white tracking-tight">
                {{ number_format($systemStats['total_users']) }}
            </div>
            <div class="flex items-center justify-between text-xs text-zinc-500 dark:text-zinc-400 font-medium mt-1">
                <span>Pengguna Terdaftar</span>
                <span class="text-emerald-600 dark:text-emerald-400 font-bold">+{{ $systemStats['new_users_this_month'] }} bln ini</span>
            </div>
        </div>

        <!-- Card 2: Roles & Permissions -->
        <div class="p-4 sm:p-5 rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200/80 dark:border-zinc-800 shadow-xs relative overflow-hidden group hover:border-zinc-300 dark:hover:border-zinc-700 transition">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shadow-xs">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                </div>
                <span class="text-[11px] font-bold px-2 py-0.5 rounded-full bg-blue-50 text-blue-700 dark:bg-blue-950/80 dark:text-blue-300 border border-blue-200/50">
                    Multi-Role
                </span>
            </div>
            <div class="text-2xl sm:text-3xl font-black text-zinc-900 dark:text-white tracking-tight">
                {{ number_format($systemStats['total_roles']) }}
            </div>
            <p class="text-xs text-zinc-500 dark:text-zinc-400 font-medium mt-1">
                Role & {{ number_format($systemStats['total_permissions']) }} Permission Aktif
            </p>
        </div>

        <!-- Card 3: Activity Logs -->
        <div class="p-4 sm:p-5 rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200/80 dark:border-zinc-800 shadow-xs relative overflow-hidden group hover:border-zinc-300 dark:hover:border-zinc-700 transition">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 rounded-xl bg-blue-50 dark:bg-blue-950/60 text-blue-600 dark:text-blue-400 flex items-center justify-center shadow-xs">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <span class="text-[11px] font-bold px-2 py-0.5 rounded-full bg-purple-50 text-purple-700 dark:bg-purple-950/80 dark:text-purple-300 border border-purple-200/50">
                    Audit Trail
                </span>
            </div>
            <div class="text-2xl sm:text-3xl font-black text-zinc-900 dark:text-white tracking-tight">
                {{ number_format($systemStats['total_activities']) }}
            </div>
            <p class="text-xs text-zinc-500 dark:text-zinc-400 font-medium mt-1">
                Total Mutasi & Log Tercatat
            </p>
        </div>

        <!-- Card 4: Server Status -->
        <div class="p-4 sm:p-5 rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200/80 dark:border-zinc-800 shadow-xs relative overflow-hidden group hover:border-zinc-300 dark:hover:border-zinc-700 transition">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 rounded-xl bg-amber-50 dark:bg-amber-950/60 text-amber-600 dark:text-amber-400 flex items-center justify-center shadow-xs">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"></path></svg>
                </div>
                <span class="text-[11px] font-bold px-2 py-0.5 rounded-full bg-amber-50 text-amber-700 dark:bg-amber-950/80 dark:text-amber-300 border border-amber-200/50">
                    {{ strtoupper($systemStats['server_info']['environment']) }}
                </span>
            </div>
            <div class="text-xl sm:text-2xl font-black text-zinc-900 dark:text-white tracking-tight">
                PHP {{ PHP_MAJOR_VERSION }}.{{ PHP_MINOR_VERSION }}
            </div>
            <p class="text-[11px] text-zinc-500 dark:text-zinc-400 font-medium mt-1">
                Laravel {{ $systemStats['server_info']['laravel_version'] }} • DB: <span class="font-bold text-zinc-700 dark:text-zinc-300">{{ $systemStats['server_info']['db_driver'] }}</span>
            </p>
        </div>
    </div>

    <!-- User Growth Analytics Chart & Growth Highlights -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-3 sm:gap-4">
        <!-- Main Registration Chart -->
        <div class="lg:col-span-2 p-4 sm:p-5 rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200/80 dark:border-zinc-800 shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between mb-2">
                <div>
                    <h2 class="text-xs font-bold uppercase tracking-wider text-zinc-500 dark:text-zinc-400 flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                        <span>Tren Pertumbuhan Pengguna Baru (6 Bulan Terakhir)</span>
                    </h2>
                    <p class="text-[11px] text-zinc-500 dark:text-zinc-400 mt-0.5">Statistik pendaftaran akun pengguna per bulan</p>
                </div>
                <span class="text-xs font-bold px-2.5 py-1 rounded-xl bg-indigo-50 text-indigo-700 dark:bg-indigo-950/80 dark:text-indigo-300 border border-indigo-200/50">
                    +{{ $systemStats['new_users_this_month'] }} Bulan Ini
                </span>
            </div>
            <div class="h-52 w-full">
                <div id="userRegistrationChart" class="h-full w-full"></div>
            </div>
        </div>

        <!-- User Growth Highlights Card -->
        <div class="p-4 sm:p-5 rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200/80 dark:border-zinc-800 shadow-xs flex flex-col justify-between">
            <div>
                <h2 class="text-xs font-bold uppercase tracking-wider text-zinc-500 dark:text-zinc-400 mb-3 flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>Aktivitas & Pertumbuhan Pengguna</span>
                </h2>
                <div class="space-y-3">
                    <div class="p-3 rounded-xl bg-zinc-50 dark:bg-zinc-800/60 border border-zinc-100 dark:border-zinc-700/50 flex items-center justify-between">
                        <div>
                            <span class="text-[10px] text-zinc-400 font-medium block">Pengguna Baru (7 Hari)</span>
                            <span class="text-base font-black text-zinc-900 dark:text-white">+{{ $systemStats['new_users_this_week'] }} Akun</span>
                        </div>
                        <div class="w-8 h-8 rounded-lg bg-emerald-100 dark:bg-emerald-900/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center font-bold text-xs">
                            7D
                        </div>
                    </div>

                    <div class="p-3 rounded-xl bg-zinc-50 dark:bg-zinc-800/60 border border-zinc-100 dark:border-zinc-700/50 flex items-center justify-between">
                        <div>
                            <span class="text-[10px] text-zinc-400 font-medium block">Role Terdefinisi</span>
                            <span class="text-base font-black text-zinc-900 dark:text-white">{{ $systemStats['total_roles'] }} Role</span>
                        </div>
                        <div class="w-8 h-8 rounded-lg bg-purple-100 dark:bg-purple-900/60 text-purple-600 dark:text-purple-400 flex items-center justify-center font-bold text-xs">
                            Role
                        </div>
                    </div>

                    <div class="p-3 rounded-xl bg-zinc-50 dark:bg-zinc-800/60 border border-zinc-100 dark:border-zinc-700/50 flex items-center justify-between">
                        <div>
                            <span class="text-[10px] text-zinc-400 font-medium block">Permission Terdaftar</span>
                            <span class="text-base font-black text-zinc-900 dark:text-white">{{ $systemStats['total_permissions'] }} Key</span>
                        </div>
                        <div class="w-8 h-8 rounded-lg bg-blue-100 dark:bg-blue-900/60 text-blue-600 dark:text-blue-400 flex items-center justify-center font-bold text-xs">
                            Key
                        </div>
                    </div>
                </div>
            </div>
            <div class="pt-3 border-t border-zinc-100 dark:border-zinc-800 flex items-center justify-between text-xs text-zinc-400">
                <span>Status Environtment</span>
                <span class="font-bold text-emerald-600 dark:text-emerald-400">Siap Digunakan</span>
            </div>
        </div>
    </div>

    <!-- Pusat Administrasi & Kontrol Cepat -->
    <div class="p-4 sm:p-5 rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200/80 dark:border-zinc-800 shadow-xs">
        <h2 class="text-xs font-bold uppercase tracking-wider text-zinc-500 dark:text-zinc-400 mb-3 flex items-center gap-1.5">
            <svg class="w-3.5 h-3.5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
            <span>Pusat Administrasi & Kontrol Cepat</span>
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3">
            <a href="{{ route('admin.users.index') }}"
                class="flex items-center gap-3 p-3 rounded-xl bg-zinc-50 dark:bg-zinc-800/60 border border-zinc-100 dark:border-zinc-700/60 hover:bg-emerald-50/60 dark:hover:bg-emerald-950/30 hover:border-emerald-200 dark:hover:border-emerald-800/60 transition group cursor-pointer">
                <div class="w-9 h-9 rounded-xl bg-emerald-100 dark:bg-emerald-900/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-bold text-zinc-900 dark:text-white truncate group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">User Management</p>
                    <p class="text-[10px] text-zinc-400 truncate">Kelola data user</p>
                </div>
            </a>

            <a href="{{ route('admin.roles.index') }}"
                class="flex items-center gap-3 p-3 rounded-xl bg-zinc-50 dark:bg-zinc-800/60 border border-zinc-100 dark:border-zinc-700/60 hover:bg-indigo-50/60 dark:hover:bg-indigo-950/30 hover:border-indigo-200 dark:hover:border-indigo-800/60 transition group cursor-pointer">
                <div class="w-9 h-9 rounded-xl bg-indigo-100 dark:bg-indigo-900/60 text-indigo-600 dark:text-indigo-400 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-bold text-zinc-900 dark:text-white truncate group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">Roles & Akses</p>
                    <p class="text-[10px] text-zinc-400 truncate">Hak permission</p>
                </div>
            </a>

            <a href="{{ route('admin.activity-logs.index') }}"
                class="flex items-center gap-3 p-3 rounded-xl bg-zinc-50 dark:bg-zinc-800/60 border border-zinc-100 dark:border-zinc-700/60 hover:bg-blue-50/60 dark:hover:bg-blue-950/30 hover:border-blue-200 dark:hover:border-blue-800/60 transition group cursor-pointer">
                <div class="w-9 h-9 rounded-xl bg-blue-100 dark:bg-blue-900/60 text-blue-600 dark:text-blue-400 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-bold text-zinc-900 dark:text-white truncate group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">Activity Logs</p>
                    <p class="text-[10px] text-zinc-400 truncate">Audit trail user</p>
                </div>
            </a>

            <a href="{{ route('admin.laravel-logs.index') }}"
                class="flex items-center gap-3 p-3 rounded-xl bg-zinc-50 dark:bg-zinc-800/60 border border-zinc-100 dark:border-zinc-700/60 hover:bg-amber-50/60 dark:hover:bg-amber-950/30 hover:border-amber-200 dark:hover:border-amber-800/60 transition group cursor-pointer">
                <div class="w-9 h-9 rounded-xl bg-amber-100 dark:bg-amber-900/60 text-amber-600 dark:text-amber-400 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-bold text-zinc-900 dark:text-white truncate group-hover:text-amber-600 dark:group-hover:text-amber-400 transition-colors">Server Logs</p>
                    <p class="text-[10px] text-zinc-400 truncate">Monitor error</p>
                </div>
            </a>

            <a href="{{ route('admin.settings.index') }}"
                class="flex items-center gap-3 p-3 rounded-xl bg-zinc-50 dark:bg-zinc-800/60 border border-zinc-100 dark:border-zinc-700/60 hover:bg-purple-50/60 dark:hover:bg-purple-950/30 hover:border-purple-200 dark:hover:border-purple-800/60 transition group cursor-pointer">
                <div class="w-9 h-9 rounded-xl bg-purple-100 dark:bg-purple-900/60 text-purple-600 dark:text-purple-400 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-bold text-zinc-900 dark:text-white truncate group-hover:text-purple-600 dark:group-hover:text-purple-400 transition-colors">Settings</p>
                    <p class="text-[10px] text-zinc-400 truncate">Branding & mail</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Bottom Lists Row: Recent Users & Recent Audit Logs -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 sm:gap-4">
        <!-- Pengguna Terdaftar Terbaru -->
        <div class="p-4 sm:p-5 rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200/80 dark:border-zinc-800 shadow-xs">
            <div class="flex items-center justify-between mb-3">
                <h2 class="text-xs font-bold uppercase tracking-wider text-zinc-500 dark:text-zinc-400 flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    <span>Pengguna Terdaftar Terbaru</span>
                </h2>
                <a href="{{ route('admin.users.index') }}" class="text-xs font-bold text-emerald-600 dark:text-emerald-400 hover:underline inline-flex items-center gap-1">
                    <span>Lihat Semua</span>
                    <span>&rarr;</span>
                </a>
            </div>
            <div class="divide-y divide-zinc-100 dark:divide-zinc-800/80">
                @forelse($systemStats['recent_users'] as $user)
                    <div class="py-2.5 flex items-center justify-between gap-3">
                        <div class="flex items-center gap-2.5 min-w-0">
                            @if($user->avatar)
                                <img src="{{ Storage::url($user->avatar) }}" alt="{{ $user->name }}" class="w-8 h-8 rounded-xl object-cover shrink-0">
                            @else
                                <div class="w-8 h-8 rounded-xl bg-gradient-to-tr from-emerald-500 to-teal-500 text-white font-bold text-xs flex items-center justify-center shrink-0 shadow-2xs">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                            @endif
                            <div class="min-w-0">
                                <p class="text-xs font-bold text-zinc-900 dark:text-white truncate">{{ $user->name }}</p>
                                <p class="text-[10px] text-zinc-400 truncate">{{ $user->email }}</p>
                            </div>
                        </div>
                        <div class="text-right shrink-0">
                            @if($user->roles->isNotEmpty())
                                <span class="px-2 py-0.5 text-[9px] font-bold rounded-md bg-zinc-100 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-300">
                                    {{ $user->roles->first()->name }}
                                </span>
                            @else
                                <span class="px-2 py-0.5 text-[9px] font-bold rounded-md bg-zinc-100 dark:bg-zinc-800 text-zinc-400">User</span>
                            @endif
                            <p class="text-[10px] text-zinc-400 mt-0.5">{{ $user->created_at ? $user->created_at->diffForHumans() : '-' }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-xs text-zinc-400 py-4 text-center">Belum ada data pengguna.</p>
                @endforelse
            </div>
        </div>

        <!-- Audit Log Aktivitas Terkini -->
        <div class="p-4 sm:p-5 rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200/80 dark:border-zinc-800 shadow-xs">
            <div class="flex items-center justify-between mb-3">
                <h2 class="text-xs font-bold uppercase tracking-wider text-zinc-500 dark:text-zinc-400 flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>Audit Log Aktivitas Terkini</span>
                </h2>
                <a href="{{ route('admin.activity-logs.index') }}" class="text-xs font-bold text-emerald-600 dark:text-emerald-400 hover:underline inline-flex items-center gap-1">
                    <span>Semua Log</span>
                    <span>&rarr;</span>
                </a>
            </div>
            <div class="divide-y divide-zinc-100 dark:divide-zinc-800/80">
                @forelse($systemStats['recent_activities'] as $log)
                    <div class="py-2.5 flex items-center justify-between gap-3">
                        <div class="flex items-center gap-2.5 min-w-0">
                            <div class="w-7 h-7 rounded-lg bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 flex items-center justify-center shrink-0">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs font-medium text-zinc-900 dark:text-white truncate">
                                    <span class="font-bold">{{ $log->user ? $log->user->name : 'System' }}</span>
                                    <span class="text-zinc-500 dark:text-zinc-400">{{ $log->description ?? $log->action ?? 'melakukan aksi' }}</span>
                                </p>
                                <p class="text-[10px] text-zinc-400">{{ $log->ip_address ?? '127.0.0.1' }}</p>
                            </div>
                        </div>
                        <span class="text-[10px] font-medium text-zinc-400 shrink-0">
                            {{ $log->created_at ? $log->created_at->diffForHumans() : '-' }}
                        </span>
                    </div>
                @empty
                    <p class="text-xs text-zinc-400 py-4 text-center">Belum ada riwayat aktivitas.</p>
                @endforelse
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const isDark = document.documentElement.classList.contains('dark');

    // 1. User Registration Growth Chart (Bar Chart)
    let userRegChart = null;
    const userGrowthTrends = @json($systemStats['user_growth_trends'] ?? []);

    if (document.querySelector("#userRegistrationChart") && userGrowthTrends.length > 0 && typeof ApexCharts !== 'undefined') {
        const userMonths = userGrowthTrends.map(item => item.month_name);
        const userCounts = userGrowthTrends.map(item => item.new_users);

        const userRegistrationOptions = {
            series: [{
                name: 'Pengguna Baru',
                data: userCounts
            }],
            chart: {
                type: 'bar',
                height: '100%',
                fontFamily: 'inherit',
                toolbar: { show: false }
            },
            plotOptions: {
                bar: {
                    borderRadius: 6,
                    columnWidth: '38%',
                    distributed: false,
                }
            },
            colors: ['#6366F1'],
            dataLabels: { enabled: false },
            xaxis: {
                categories: userMonths,
                axisBorder: { show: false },
                axisTicks: { show: false },
                labels: {
                    style: { colors: isDark ? '#9CA3AF' : '#6B7280', fontSize: '11px', fontWeight: 500 }
                }
            },
            yaxis: {
                labels: {
                    formatter: function(val) { return Math.round(val); },
                    style: { colors: isDark ? '#9CA3AF' : '#6B7280', fontSize: '10px' }
                }
            },
            grid: {
                borderColor: isDark ? '#27272A' : '#F4F4F5',
                strokeDashArray: 4,
                padding: { top: 0, right: 0, bottom: 0, left: 10 }
            },
            tooltip: {
                theme: isDark ? 'dark' : 'light',
                y: {
                    formatter: function(val) { return val + ' Pengguna'; }
                }
            }
        };

        userRegChart = new ApexCharts(document.querySelector("#userRegistrationChart"), userRegistrationOptions);
        userRegChart.render();
    }

    function updateChartsTheme(dark) {
        if (userRegChart) {
            userRegChart.updateOptions({
                xaxis: { labels: { style: { colors: dark ? '#9CA3AF' : '#6B7280' } } },
                yaxis: { labels: { style: { colors: dark ? '#9CA3AF' : '#6B7280' } } },
                grid: { borderColor: dark ? '#27272A' : '#F4F4F5' },
                tooltip: { theme: dark ? 'dark' : 'light' }
            }, false, false);
        }
    }

    window.addEventListener('theme-changed', (e) => {
        updateChartsTheme(e.detail.isDark);
    });

    const themeObserver = new MutationObserver(() => {
        const dark = document.documentElement.classList.contains('dark');
        updateChartsTheme(dark);
    });
    themeObserver.observe(document.documentElement, { attributes: true, attributeFilter: ['class'] });
});
</script>
@endpush
