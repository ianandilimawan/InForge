@extends('admin.layouts.app')

@section('page-title', 'UI Components')

@section('content')
<div class="space-y-8 pb-12" x-data="{
    buttonLoading: false,
    activeTab: 'all',
    toggleLoading() {
        this.buttonLoading = true;
        setTimeout(() => this.buttonLoading = false, 2500);
    }
}">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-base sm:text-lg md:text-xl font-bold tracking-tight text-zinc-900 dark:text-white">
                UI Components Showcase
            </h1>
            <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">
                Standardized Blade design system and reusable component primitives for clean, rapid CRUD development.
            </p>
        </div>
        <div class="flex items-center gap-2">
            <x-button variant="secondary" icon="arrow-left" href="{{ route('admin.dashboard') }}">
                Dashboard
            </x-button>
            <x-button variant="primary" icon="check" @click="window.dispatchEvent(new CustomEvent('notify', { detail: { message: 'Welcome to InForge UI Kit!', type: 'success' } }))">
                Test Notification
            </x-button>
        </div>
    </div>

    <!-- Quick Navigation Pills -->
    <div class="flex items-center gap-2 overflow-x-auto pb-1 text-xs no-scrollbar">
        <a href="#buttons" class="px-3 py-1.5 rounded-xl font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 hover:text-emerald-600 dark:hover:text-emerald-400 border border-zinc-200/60 dark:border-zinc-700/60 transition-colors shrink-0">
            Buttons
        </a>
        <a href="#badges" class="px-3 py-1.5 rounded-xl font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 hover:text-emerald-600 dark:hover:text-emerald-400 border border-zinc-200/60 dark:border-zinc-700/60 transition-colors shrink-0">
            Badges & Statuses
        </a>
        <a href="#cards" class="px-3 py-1.5 rounded-xl font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 hover:text-emerald-600 dark:hover:text-emerald-400 border border-zinc-200/60 dark:border-zinc-700/60 transition-colors shrink-0">
            Cards & Containers
        </a>
        <a href="#inputs" class="px-3 py-1.5 rounded-xl font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 hover:text-emerald-600 dark:hover:text-emerald-400 border border-zinc-200/60 dark:border-zinc-700/60 transition-colors shrink-0">
            Form Controls
        </a>
        <a href="#alerts" class="px-3 py-1.5 rounded-xl font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 hover:text-emerald-600 dark:hover:text-emerald-400 border border-zinc-200/60 dark:border-zinc-700/60 transition-colors shrink-0">
            Alerts & Toasts
        </a>
    </div>

    <!-- 1. BUTTONS SECTION -->
    <section id="buttons" class="space-y-6">
        <div class="flex items-center gap-2 border-b border-zinc-200/80 dark:border-zinc-800 pb-3">
            <div class="w-6 h-6 rounded-lg bg-emerald-100 dark:bg-emerald-950/60 flex items-center justify-center text-emerald-600 dark:text-emerald-400">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"></path></svg>
            </div>
            <div>
                <h2 class="text-sm font-bold text-zinc-900 dark:text-white">Buttons (&lt;x-button&gt;)</h2>
                <p class="text-[11px] text-zinc-500">Sleek, pill-styled interactive buttons and links with automatic dark mode harmony.</p>
            </div>
        </div>

        <!-- Color Variants -->
        <x-card title="Color Variants" subtitle="Standard soft pill badges designed to match navbar action aesthetics.">
            <div class="flex flex-wrap items-center gap-2.5">
                <x-button variant="primary">Primary (Emerald)</x-button>
                <x-button variant="secondary">Secondary (Zinc)</x-button>
                <x-button variant="info">Info (Blue)</x-button>
                <x-button variant="danger">Danger (Rose)</x-button>
                <x-button variant="warning">Warning (Amber)</x-button>
                <x-button variant="purple">Purple (Violet)</x-button>
                <x-button variant="dark">Dark</x-button>
                <x-button variant="outline">Outline</x-button>
                <x-button variant="ghost">Ghost</x-button>
            </div>

            <div class="mt-4 pt-4 border-t border-zinc-100 dark:border-zinc-800">
                <p class="text-[11px] font-semibold text-zinc-500 mb-2">Solid High-Contrast Variants:</p>
                <div class="flex flex-wrap items-center gap-2.5">
                    <x-button variant="solid-emerald">Solid Emerald</x-button>
                    <x-button variant="solid-blue">Solid Blue</x-button>
                    <x-button variant="solid-danger">Solid Danger</x-button>
                </div>
            </div>
        </x-card>

        <!-- Sizes & Icons -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-card title="Sizes" subtitle="From compact table actions to prominent form submits.">
                <div class="flex flex-wrap items-end gap-3">
                    <x-button size="xs">Extra Small (xs)</x-button>
                    <x-button size="sm">Small (sm)</x-button>
                    <x-button size="md">Medium (md - Default)</x-button>
                    <x-button size="lg">Large (lg)</x-button>
                    <x-button size="xl">Extra Large (xl)</x-button>
                </div>
            </x-card>

            <x-card title="Buttons with Icons" subtitle="Seamless integration with Heroicons or custom SVGs.">
                <div class="flex flex-wrap items-center gap-2.5">
                    <x-button variant="primary" icon="plus">Add Record</x-button>
                    <x-button variant="secondary" icon="arrow-left">Go Back</x-button>
                    <x-button variant="info" icon="download">Download CSV</x-button>
                    <x-button variant="warning" icon="refresh">Refresh</x-button>
                    <x-button variant="danger" icon="trash">Delete</x-button>
                    <x-button variant="purple" iconRight="arrow-right">Next Step</x-button>
                </div>
            </x-card>
        </div>

        <!-- Interactive States & Code Snippet -->
        <x-card title="Interactive States & Loading Demo" subtitle="Live state transitions, disabled locks, and loading spinners.">
            <div class="flex flex-wrap items-center gap-4">
                <x-button variant="primary" disabled>Disabled State</x-button>
                <x-button variant="secondary" disabled icon="lock">Locked Action</x-button>
                
                <!-- Loading Toggle Demo -->
                <button type="button" @click="toggleLoading"
                    class="inline-flex items-center gap-1.5 px-4 py-2 text-xs font-bold text-emerald-700 dark:text-emerald-300 hover:text-emerald-800 dark:hover:text-emerald-200 bg-emerald-50 dark:bg-emerald-950/60 hover:bg-emerald-100 dark:hover:bg-emerald-900/60 border border-emerald-200/60 dark:border-emerald-800/60 rounded-xl transition-all cursor-pointer shadow-2xs">
                    <span x-show="!buttonLoading" class="inline-flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Click Me to Test Loading
                    </span>
                    <span x-show="buttonLoading" style="display: none;" class="inline-flex items-center gap-1.5">
                        <svg class="animate-spin h-3.5 w-3.5 text-emerald-700 dark:text-emerald-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Processing Request...
                    </span>
                </button>
            </div>

            <!-- Copyable Syntax Snippet -->
            <div class="mt-5 p-3.5 rounded-xl bg-zinc-900 dark:bg-black text-zinc-300 font-mono text-xs overflow-x-auto">
                <div class="flex items-center justify-between text-[11px] text-zinc-400 mb-2 border-b border-zinc-800 pb-1.5">
                    <span>Blade Usage Example</span>
                    <span class="text-emerald-400">copy-paste ready</span>
                </div>
                <pre class="text-zinc-300">&lt;!-- Primary Action Button --&gt;
&lt;x-button variant="primary" icon="plus"&gt;Create User&lt;/x-button&gt;

&lt;!-- Link As Button --&gt;
&lt;x-button variant="secondary" icon="arrow-left" href="{{ route('admin.dashboard') }}"&gt;Back&lt;/x-button&gt;

&lt;!-- Danger Action with Confirmation --&gt;
&lt;x-button variant="danger" icon="trash" @click="confirmDelete"&gt;Delete&lt;/x-button&gt;</pre>
            </div>
        </x-card>
    </section>

    <!-- 2. BADGES SECTION -->
    <section id="badges" class="space-y-6">
        <div class="flex items-center gap-2 border-b border-zinc-200/80 dark:border-zinc-800 pb-3">
            <div class="w-6 h-6 rounded-lg bg-blue-100 dark:bg-blue-950/60 flex items-center justify-center text-blue-600 dark:text-blue-400">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
            </div>
            <div>
                <h2 class="text-sm font-bold text-zinc-900 dark:text-white">Badges & Statuses (&lt;x-badge&gt;)</h2>
                <p class="text-[11px] text-zinc-500">Tags, indicators, and status chips for tables, headers, and logs.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-card title="Status Badges with Dot Indicator" subtitle="Ideal for record statuses (Active, Pending, Suspended).">
                <div class="flex flex-wrap items-center gap-2.5">
                    <x-badge variant="success" dot>Active</x-badge>
                    <x-badge variant="warning" dot>Pending Review</x-badge>
                    <x-badge variant="danger" dot>Suspended</x-badge>
                    <x-badge variant="info" dot>Processing</x-badge>
                    <x-badge variant="secondary" dot>Draft</x-badge>
                    <x-badge variant="purple" dot>Premium</x-badge>
                </div>
            </x-card>

            <x-card title="Plain Badges & Sizes" subtitle="Standard text badges in sm, md, and lg sizes.">
                <div class="space-y-3">
                    <div class="flex flex-wrap items-center gap-2">
                        <x-badge variant="success" size="sm">Small</x-badge>
                        <x-badge variant="info" size="md">Medium</x-badge>
                        <x-badge variant="purple" size="lg">Large</x-badge>
                    </div>
                    <div class="flex flex-wrap items-center gap-2">
                        <x-badge variant="secondary" rounded="rounded-md">Rounded-md</x-badge>
                        <x-badge variant="primary" rounded="rounded-xl">Rounded-xl</x-badge>
                        <x-badge variant="danger" rounded="rounded-full">Pill (full)</x-badge>
                    </div>
                </div>
            </x-card>
        </div>
    </section>

    <!-- 3. CARDS & CONTAINERS SECTION -->
    <section id="cards" class="space-y-6">
        <div class="flex items-center gap-2 border-b border-zinc-200/80 dark:border-zinc-800 pb-3">
            <div class="w-6 h-6 rounded-lg bg-purple-100 dark:bg-purple-950/60 flex items-center justify-center text-purple-600 dark:text-purple-400">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
            </div>
            <div>
                <h2 class="text-sm font-bold text-zinc-900 dark:text-white">Cards (&lt;x-card&gt;)</h2>
                <p class="text-[11px] text-zinc-500">Consistent container panels with header actions, clean borders, and soft shadows.</p>
            </div>
        </div>

        <x-card title="Metric & Stat Card Showcase" subtitle="Standard stat block pattern used on Dashboard Overview.">
            <x-slot:actions>
                <x-button variant="secondary" size="sm" icon="refresh">Refresh Stats</x-button>
            </x-slot:actions>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="p-4 rounded-xl bg-zinc-50 dark:bg-zinc-800/40 border border-zinc-100 dark:border-zinc-800">
                    <p class="text-[11px] font-bold uppercase tracking-wider text-zinc-400">Total Users</p>
                    <div class="flex items-baseline justify-between mt-1">
                        <span class="text-xl font-extrabold text-zinc-900 dark:text-white">1,280</span>
                        <x-badge variant="success" size="sm" dot>+12%</x-badge>
                    </div>
                </div>

                <div class="p-4 rounded-xl bg-zinc-50 dark:bg-zinc-800/40 border border-zinc-100 dark:border-zinc-800">
                    <p class="text-[11px] font-bold uppercase tracking-wider text-zinc-400">System Logs</p>
                    <div class="flex items-baseline justify-between mt-1">
                        <span class="text-xl font-extrabold text-zinc-900 dark:text-white">342</span>
                        <x-badge variant="info" size="sm">Stable</x-badge>
                    </div>
                </div>

                <div class="p-4 rounded-xl bg-zinc-50 dark:bg-zinc-800/40 border border-zinc-100 dark:border-zinc-800">
                    <p class="text-[11px] font-bold uppercase tracking-wider text-zinc-400">Pending Tasks</p>
                    <div class="flex items-baseline justify-between mt-1">
                        <span class="text-xl font-extrabold text-zinc-900 dark:text-white">18</span>
                        <x-badge variant="warning" size="sm">Action Req.</x-badge>
                    </div>
                </div>

                <div class="p-4 rounded-xl bg-zinc-50 dark:bg-zinc-800/40 border border-zinc-100 dark:border-zinc-800">
                    <p class="text-[11px] font-bold uppercase tracking-wider text-zinc-400">Security Health</p>
                    <div class="flex items-baseline justify-between mt-1">
                        <span class="text-xl font-extrabold text-emerald-600 dark:text-emerald-400">100%</span>
                        <x-badge variant="success" size="sm">Passed</x-badge>
                    </div>
                </div>
            </div>

            <x-slot:footer>
                <div class="flex items-center justify-between text-xs text-zinc-500">
                    <span>Card Footer Slot with metadata or quick links</span>
                    <a href="{{ route('admin.dashboard') }}" class="text-emerald-600 dark:text-emerald-400 hover:underline font-bold">Go to Dashboard &rarr;</a>
                </div>
            </x-slot:footer>
        </x-card>
    </section>

    <!-- 4. FORM CONTROLS SECTION -->
    <section id="inputs" class="space-y-6">
        <div class="flex items-center gap-2 border-b border-zinc-200/80 dark:border-zinc-800 pb-3">
            <div class="w-6 h-6 rounded-lg bg-amber-100 dark:bg-amber-950/60 flex items-center justify-center text-amber-600 dark:text-amber-400">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
            </div>
            <div>
                <h2 class="text-sm font-bold text-zinc-900 dark:text-white">Form Controls & Inputs</h2>
                <p class="text-[11px] text-zinc-500">Pre-styled interactive input controls ready for forms and CRUD operations.</p>
            </div>
        </div>

        <x-card title="Interactive Input Types" subtitle="All inputs respect dark mode and focus ring tokens.">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Standard Input -->
                <x-input name="demo_name" label="Standard Input (&lt;x-input&gt;)" placeholder="Enter full name" value="John Doe" />

                <!-- Floating Label Input -->
                <div class="pt-4">
                    <x-input-floating name="demo_floating" label="Floating Input (&lt;x-input-floating&gt;)" value="admin@example.com" />
                </div>

                <!-- Toggle Switch -->
                <div>
                    <x-toggle name="demo_toggle" label="Toggle Switch (&lt;x-toggle&gt;)" :checked="true" />
                    <p class="text-[11px] text-zinc-400 mt-1">Automatic hidden fallback for boolean fields.</p>
                </div>
            </div>
        </x-card>
    </section>

    <!-- 5. ALERTS & NOTIFICATIONS SECTION -->
    <section id="alerts" class="space-y-6">
        <div class="flex items-center gap-2 border-b border-zinc-200/80 dark:border-zinc-800 pb-3">
            <div class="w-6 h-6 rounded-lg bg-rose-100 dark:bg-rose-950/60 flex items-center justify-center text-rose-600 dark:text-rose-400">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
            </div>
            <div>
                <h2 class="text-sm font-bold text-zinc-900 dark:text-white">Alerts & Notifications</h2>
                <p class="text-[11px] text-zinc-500">Inline warning boxes (&lt;x-alert&gt;) and SweetAlert/Alpine toast events.</p>
            </div>
        </div>

        <!-- Inline Banners -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <x-alert variant="success" title="Success Alert" dismissible>
                Your changes have been saved to the database successfully.
            </x-alert>

            <x-alert variant="info" title="Information Note" dismissible>
                System maintenance is scheduled for Sunday at 02:00 UTC.
            </x-alert>

            <x-alert variant="warning" title="Security Warning" dismissible>
                Two-Factor Authentication is currently recommended for all administrator roles.
            </x-alert>

            <x-alert variant="danger" title="Error Encountered" dismissible>
                Unable to connect to payment gateway. Please check your API credentials.
            </x-alert>
        </div>

        <!-- Interactive Toast Triggers -->
        <x-card title="Interactive Toast Notification Triggers" subtitle="Click any button below to trigger real-time toast messages.">
            <div class="flex flex-wrap items-center gap-3">
                <x-button variant="primary" icon="check"
                    @click="window.dispatchEvent(new CustomEvent('notify', { detail: { message: 'Item created successfully!', type: 'success' } }))">
                    Trigger Success Toast
                </x-button>

                <x-button variant="danger" icon="trash"
                    @click="window.dispatchEvent(new CustomEvent('notify', { detail: { message: 'Failed to delete record!', type: 'error' } }))">
                    Trigger Error Toast
                </x-button>

                <x-button variant="warning" icon="exclamation-circle"
                    @click="window.dispatchEvent(new CustomEvent('notify', { detail: { message: 'Warning: Session expiring soon.', type: 'warning' } }))">
                    Trigger Warning Toast
                </x-button>

                <x-button variant="info" icon="information-circle"
                    @click="window.dispatchEvent(new CustomEvent('notify', { detail: { message: 'Background batch completed.', type: 'info' } }))">
                    Trigger Info Toast
                </x-button>

                <!-- SweetAlert Confirmation Modal Test -->
                <x-button variant="secondary" icon="fa fa-bell"
                    @click="window.dispatchEvent(new CustomEvent('open-delete-modal', { detail: { action: '#' } }))">
                    Test SweetAlert Confirm Modal
                </x-button>
            </div>
        </x-card>
    </section>
</div>
@endsection
