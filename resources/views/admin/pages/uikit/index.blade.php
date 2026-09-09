@extends('admin.layouts.app')

@section('page-title', 'UI Components')

@section('content')
<div class="space-y-8 pb-16" x-data="{
    buttonLoading: false,
    showPassword: false,
    toggleLoading() {
        this.buttonLoading = true;
        setTimeout(() => this.buttonLoading = false, 2500);
    }
}">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="px-2 py-0.5 rounded-md font-mono text-[10px] font-extrabold bg-emerald-100 dark:bg-emerald-950/80 text-emerald-700 dark:text-emerald-300 border border-emerald-200/60 dark:border-emerald-800/60 uppercase">
                    v3.0 UI Kit
                </span>
                <span class="text-xs text-zinc-400">&bull;</span>
                <span class="text-xs text-zinc-500 dark:text-zinc-400">100% Native Blade Components Directory</span>
            </div>
            <h1 class="text-base sm:text-lg md:text-xl font-bold tracking-tight text-zinc-900 dark:text-white">
                UI Components Showcase
            </h1>
            <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">
                Live interactive showcase of all 20 pre-built Blade components, buttons, inputs, rich text editor, and modals.
            </p>
        </div>
        <div class="flex items-center gap-2">
            <x-button variant="secondary" icon="arrow-left" href="{{ route('admin.dashboard') }}">
                Dashboard
            </x-button>
            <x-button variant="primary" icon="check" @click="window.dispatchEvent(new CustomEvent('notify', { detail: { message: 'All components loaded and verified!', type: 'success' } }))">
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
            Badges
        </a>
        <a href="#standard-inputs" class="px-3 py-1.5 rounded-xl font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 hover:text-emerald-600 dark:hover:text-emerald-400 border border-zinc-200/60 dark:border-zinc-700/60 transition-colors shrink-0">
            Standard Inputs
        </a>
        <a href="#floating-inputs" class="px-3 py-1.5 rounded-xl font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 hover:text-emerald-600 dark:hover:text-emerald-400 border border-zinc-200/60 dark:border-zinc-700/60 transition-colors shrink-0">
            Floating Inputs
        </a>
        <a href="#form-groups" class="px-3 py-1.5 rounded-xl font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 hover:text-emerald-600 dark:hover:text-emerald-400 border border-zinc-200/60 dark:border-zinc-700/60 transition-colors shrink-0">
            Form Groups
        </a>
        <a href="#select-inputs" class="px-3 py-1.5 rounded-xl font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 hover:text-emerald-600 dark:hover:text-emerald-400 border border-zinc-200/60 dark:border-zinc-700/60 transition-colors shrink-0">
            Select & Dropdowns
        </a>
        <a href="#textareas" class="px-3 py-1.5 rounded-xl font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 hover:text-emerald-600 dark:hover:text-emerald-400 border border-zinc-200/60 dark:border-zinc-700/60 transition-colors shrink-0">
            Textareas & TinyMCE
        </a>
        <a href="#toggles" class="px-3 py-1.5 rounded-xl font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 hover:text-emerald-600 dark:hover:text-emerald-400 border border-zinc-200/60 dark:border-zinc-700/60 transition-colors shrink-0">
            Toggles & Selectors
        </a>
        <a href="#uploads" class="px-3 py-1.5 rounded-xl font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 hover:text-emerald-600 dark:hover:text-emerald-400 border border-zinc-200/60 dark:border-zinc-700/60 transition-colors shrink-0">
            Pickers & FilePond
        </a>
        <a href="#cards" class="px-3 py-1.5 rounded-xl font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 hover:text-emerald-600 dark:hover:text-emerald-400 border border-zinc-200/60 dark:border-zinc-700/60 transition-colors shrink-0">
            Cards
        </a>
        <a href="#alerts" class="px-3 py-1.5 rounded-xl font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 hover:text-emerald-600 dark:hover:text-emerald-400 border border-zinc-200/60 dark:border-zinc-700/60 transition-colors shrink-0">
            Alerts & Toasts
        </a>
        <a href="#modals" class="px-3 py-1.5 rounded-xl font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 hover:text-emerald-600 dark:hover:text-emerald-400 border border-zinc-200/60 dark:border-zinc-700/60 transition-colors shrink-0">
            Modals & Dialogs
        </a>
        <a href="#stats" class="px-3 py-1.5 rounded-xl font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 hover:text-emerald-600 dark:hover:text-emerald-400 border border-zinc-200/60 dark:border-zinc-700/60 transition-colors shrink-0">
            Stats & KPIs
        </a>
        <a href="#tabs" class="px-3 py-1.5 rounded-xl font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 hover:text-emerald-600 dark:hover:text-emerald-400 border border-zinc-200/60 dark:border-zinc-700/60 transition-colors shrink-0">
            Tabs & Segmented
        </a>
        <a href="#tables" class="px-3 py-1.5 rounded-xl font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 hover:text-emerald-600 dark:hover:text-emerald-400 border border-zinc-200/60 dark:border-zinc-700/60 transition-colors shrink-0">
            Data Tables & Actions
        </a>
        <a href="#avatars" class="px-3 py-1.5 rounded-xl font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 hover:text-emerald-600 dark:hover:text-emerald-400 border border-zinc-200/60 dark:border-zinc-700/60 transition-colors shrink-0">
            Avatars & Skeletons
        </a>
        <a href="#navigation" class="px-3 py-1.5 rounded-xl font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 hover:text-emerald-600 dark:hover:text-emerald-400 border border-zinc-200/60 dark:border-zinc-700/60 transition-colors shrink-0">
            Breadcrumbs & Steppers
        </a>
        <a href="#timeline" class="px-3 py-1.5 rounded-xl font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 hover:text-emerald-600 dark:hover:text-emerald-400 border border-zinc-200/60 dark:border-zinc-700/60 transition-colors shrink-0">
            Timeline
        </a>
        <a href="#collapsible" class="px-3 py-1.5 rounded-xl font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 hover:text-emerald-600 dark:hover:text-emerald-400 border border-zinc-200/60 dark:border-zinc-700/60 transition-colors shrink-0">
            Accordion & Drawer
        </a>
        <a href="#progress" class="px-3 py-1.5 rounded-xl font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 hover:text-emerald-600 dark:hover:text-emerald-400 border border-zinc-200/60 dark:border-zinc-700/60 transition-colors shrink-0">
            Progress & Lists
        </a>
        <a href="#micro" class="px-3 py-1.5 rounded-xl font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 hover:text-emerald-600 dark:hover:text-emerald-400 border border-zinc-200/60 dark:border-zinc-700/60 transition-colors shrink-0">
            Micro & Helpers
        </a>
    </div>

    <!-- 1. BUTTONS SECTION -->
    <section id="buttons" class="space-y-6">
        <div class="flex items-center gap-2 border-b border-zinc-200/80 dark:border-zinc-800 pb-3">
            <div class="w-6 h-6 rounded-lg bg-emerald-100 dark:bg-emerald-950/60 flex items-center justify-center text-emerald-600 dark:text-emerald-400">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"></path></svg>
            </div>
            <div>
                <div class="flex items-center gap-2">
                    <h2 class="text-sm font-bold text-zinc-900 dark:text-white">Buttons</h2>
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">&lt;x-button&gt;</span>
                </div>
                <p class="text-[11px] text-zinc-500">Pill badges with subtle translucent borders, micro-shadows, and smooth hover states.</p>
            </div>
        </div>

        <!-- Color Variants: Outline & Solid High-Contrast -->
        <x-card title="Button Styling Paradigms: Outline vs Solid High-Contrast" subtitle="Choose between modern soft badges (current outline style) or punchy solid high-contrast buttons via :solid='true'.">
            <div class="space-y-5">
                <!-- Group 1: Outline / Soft Pill Badges -->
                <div>
                    <div class="flex items-center gap-2 mb-2.5">
                        <span class="text-xs font-bold text-zinc-900 dark:text-zinc-100">1. Outline / Soft Badge Style</span>
                        <span class="px-2 py-0.5 rounded text-[10px] font-mono text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/60 border border-emerald-200/60 dark:border-emerald-800/60">default / style="outline"</span>
                    </div>
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
                </div>

                <!-- Group 2: Solid High-Contrast Variants -->
                <div class="pt-4 border-t border-zinc-100 dark:border-zinc-800">
                    <div class="flex items-center gap-2 mb-2.5">
                        <span class="text-xs font-bold text-zinc-900 dark:text-zinc-100">2. Solid High-Contrast Style</span>
                        <span class="px-2 py-0.5 rounded text-[10px] font-mono text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/60 border border-emerald-200/60 dark:border-emerald-800/60">:solid="true"</span>
                    </div>
                    <div class="flex flex-wrap items-center gap-2.5">
                        <x-button variant="primary" :solid="true">Solid Primary</x-button>
                        <x-button variant="secondary" :solid="true">Solid Secondary</x-button>
                        <x-button variant="danger" :solid="true">Solid Danger</x-button>
                        <x-button variant="info" :solid="true">Solid Blue</x-button>
                        <x-button variant="warning" :solid="true">Solid Warning</x-button>
                        <x-button variant="purple" :solid="true">Solid Purple</x-button>
                        <x-button variant="dark" :solid="true">Solid Dark</x-button>
                    </div>
                </div>
            </div>
        </x-card>

        <!-- Sizes & Icons -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-card title="Button Sizes" subtitle="From compact data-table actions to prominent submit buttons.">
                <div class="flex flex-wrap items-end gap-3">
                    <x-button size="xs">Extra Small (xs)</x-button>
                    <x-button size="sm">Small (sm)</x-button>
                    <x-button size="md">Medium (md - Default)</x-button>
                    <x-button size="lg">Large (lg)</x-button>
                    <x-button size="xl">Extra Large (xl)</x-button>
                </div>
            </x-card>

            <x-card title="Buttons with Icons" subtitle="Heroicons and custom SVGs passed via icon or iconRight props.">
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

        <!-- Interactive States & Snippet -->
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

            <!-- Code Snippet -->
            <div class="mt-5 p-3.5 rounded-xl bg-zinc-900 dark:bg-black text-zinc-300 font-mono text-xs overflow-x-auto">
                <div class="flex items-center justify-between text-[11px] text-zinc-400 mb-2 border-b border-zinc-800 pb-1.5">
                    <span>Blade Usage Example</span>
                    <span class="text-emerald-400">copy-paste ready</span>
                </div>
                <pre class="text-zinc-300">&lt;x-button variant="primary" icon="plus"&gt;Create User&lt;/x-button&gt;
&lt;x-button variant="secondary" icon="arrow-left" href="{{ route('admin.dashboard') }}"&gt;Back&lt;/x-button&gt;
&lt;x-button variant="danger" icon="trash"&gt;Delete Record&lt;/x-button&gt;</pre>
            </div>
        </x-card>
    </section>

    <!-- 2. BADGES & STATUSES SECTION -->
    <section id="badges" class="space-y-6">
        <div class="flex items-center gap-2 border-b border-zinc-200/80 dark:border-zinc-800 pb-3">
            <div class="w-6 h-6 rounded-lg bg-blue-100 dark:bg-blue-950/60 flex items-center justify-center text-blue-600 dark:text-blue-400">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
            </div>
            <div>
                <div class="flex items-center gap-2">
                    <h2 class="text-sm font-bold text-zinc-900 dark:text-white">Badges & Statuses</h2>
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">&lt;x-badge&gt;</span>
                </div>
                <p class="text-[11px] text-zinc-500">Tags, record status chips, and indicators with optional status dots.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-card title="Status Badges with Dot Indicator" subtitle="Ideal for datatable status columns (Active, Pending, Suspended).">
                <div class="flex flex-wrap items-center gap-2.5">
                    <x-badge variant="success" dot>Active</x-badge>
                    <x-badge variant="warning" dot>Pending Review</x-badge>
                    <x-badge variant="danger" dot>Suspended</x-badge>
                    <x-badge variant="info" dot>Processing</x-badge>
                    <x-badge variant="secondary" dot>Draft</x-badge>
                    <x-badge variant="purple" dot>Premium</x-badge>
                </div>
            </x-card>

            <x-card title="Badge Sizes & Shapes" subtitle="Rounded-xl, rounded-full, or compact sizes.">
                <div class="space-y-3">
                    <div class="flex flex-wrap items-center gap-2">
                        <x-badge variant="success" size="sm">Small (sm)</x-badge>
                        <x-badge variant="info" size="md">Medium (md)</x-badge>
                        <x-badge variant="purple" size="lg">Large (lg)</x-badge>
                    </div>
                    <div class="flex flex-wrap items-center gap-2">
                        <x-badge variant="secondary" rounded="rounded-md">rounded-md</x-badge>
                        <x-badge variant="primary" rounded="rounded-xl">rounded-xl</x-badge>
                        <x-badge variant="danger" rounded="rounded-full">rounded-full (pill)</x-badge>
                    </div>
                </div>
            </x-card>
        </div>
    </section>

    <!-- 3. STANDARD & MODERN INPUTS (EXTERNAL LABELS - PERFECTLY ALIGNED) -->
    <section id="standard-inputs" class="space-y-6">
        <div class="flex items-center gap-2 border-b border-zinc-200/80 dark:border-zinc-800 pb-3">
            <div class="w-6 h-6 rounded-lg bg-amber-100 dark:bg-amber-950/60 flex items-center justify-center text-amber-600 dark:text-amber-400">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
            </div>
            <div>
                <div class="flex items-center gap-2">
                    <h2 class="text-sm font-bold text-zinc-900 dark:text-white">Standard & Modern Inputs</h2>
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">&lt;x-input&gt;</span>
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">&lt;x-modern-input&gt;</span>
                </div>
                <p class="text-[11px] text-zinc-500">Inputs with clean external labels, currency masks, and icon slots &mdash; all aligned to the pixel.</p>
            </div>
        </div>

        <x-card title="Standard Inputs Grid" subtitle="Every input in this row shares identical label spacing and box heights for perfect vertical alignment.">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- 1. Standard Input -->
                <div class="flex flex-col justify-start">
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-[11px] font-semibold text-zinc-400">Default Text</span>
                        <span class="text-[10px] font-mono text-emerald-600 dark:text-emerald-400">&lt;x-input&gt;</span>
                    </div>
                    <x-input name="demo_fullname" label="Full Name" placeholder="e.g. Andy Ian" value="Andy Ian" />
                </div>

                <!-- 2. Currency Input -->
                <div class="flex flex-col justify-start">
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-[11px] font-semibold text-zinc-400">Currency Mask</span>
                        <span class="text-[10px] font-mono text-emerald-600 dark:text-emerald-400">:isCurrency="true"</span>
                    </div>
                    <x-input name="demo_price" label="Project Budget (IDR)" placeholder="100.000" :isCurrency="true" value="15000000" />
                </div>

                <!-- 3. Modern Input with Icon -->
                <div class="flex flex-col justify-start">
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-[11px] font-semibold text-zinc-400">Icon Prefix Slot</span>
                        <span class="text-[10px] font-mono text-emerald-600 dark:text-emerald-400">&lt;x-modern-input&gt;</span>
                    </div>
                    <x-modern-input name="demo_email" label="Email Address" type="email" value="andy@intechstudio.id">
                        <x-slot:iconSlot>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </x-slot:iconSlot>
                    </x-modern-input>
                </div>

                <!-- 4. Password with Strength Meter -->
                <div class="flex flex-col justify-start">
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-[11px] font-semibold text-zinc-400">Password Strength</span>
                        <span class="text-[10px] font-mono text-emerald-600 dark:text-emerald-400">&lt;x-password&gt;</span>
                    </div>
                    <x-password name="demo_pwd" label="Security Password" value="SecretP@ssw0rd!" :strength="true" />
                </div>

                <!-- 5. Search Input with Icon -->
                <div class="flex flex-col justify-start">
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-[11px] font-semibold text-zinc-400">Search Filter</span>
                        <span class="text-[10px] font-mono text-emerald-600 dark:text-emerald-400">iconSlot</span>
                    </div>
                    <x-modern-input name="demo_search" label="Search Keywords" placeholder="Search tables, users...">
                        <x-slot:iconSlot>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </x-slot:iconSlot>
                    </x-modern-input>
                </div>

                <!-- 6. Readonly / Disabled Input -->
                <div class="flex flex-col justify-start">
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-[11px] font-semibold text-zinc-400">Readonly / Locked</span>
                        <span class="text-[10px] font-mono text-zinc-400">disabled</span>
                    </div>
                    <x-input name="demo_disabled" label="System ID (Auto)" value="USR-98421" disabled />
                </div>
            </div>
        </x-card>

        <!-- Card 2: Input Hints, Tooltips, Required & Validation States -->
        <x-card title="Input Hints, Tooltips, Required & Validation States" subtitle="Required asterisks, label tooltips, corner tags, helper hints, live character counters, one-click clear, and validation states.">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 pt-2">
                <!-- 1. Required + Tooltip + Hint -->
                <div class="flex flex-col justify-start">
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-[11px] font-semibold text-zinc-400">Required + Tooltip + Hint</span>
                        <span class="text-[10px] font-mono text-emerald-600 dark:text-emerald-400">:required :tooltip :hint</span>
                    </div>
                    <x-input name="demo_tax_id" label="NPWP / Tax ID" placeholder="00.000.000.0-000.000" :required="true" tooltip="16-digit official Tax Identification Number." hint="Format: 16 digits without punctuation." value="98.123.456.7-890.000" />
                </div>

                <!-- 2. Corner Hint Text -->
                <div class="flex flex-col justify-start">
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-[11px] font-semibold text-zinc-400">Corner Hint Text</span>
                        <span class="text-[10px] font-mono text-emerald-600 dark:text-emerald-400">corner="Optional"</span>
                    </div>
                    <x-input name="demo_backup_email" label="Recovery Email" type="email" placeholder="backup@domain.com" corner="Optional" hint="Used for account recovery if primary email is inaccessible." />
                </div>

                <!-- 3. Character Counter -->
                <div class="flex flex-col justify-start">
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-[11px] font-semibold text-zinc-400">Character Counter</span>
                        <span class="text-[10px] font-mono text-emerald-600 dark:text-emerald-400">:counter :maxlength="60"</span>
                    </div>
                    <x-input name="demo_meta_title" label="SEO Meta Title" placeholder="Title for search engines..." :maxlength="60" :counter="true" value="Base Code Admin - Modern Dashboard UI Kit" hint="Optimal length between 40 - 60 characters for search engines." />
                </div>

                <!-- 4. One-Click Clearable -->
                <div class="flex flex-col justify-start">
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-[11px] font-semibold text-zinc-400">One-Click Clearable</span>
                        <span class="text-[10px] font-mono text-emerald-600 dark:text-emerald-400">:clearable="true"</span>
                    </div>
                    <x-input name="demo_filter_tag" label="Quick Filter Tag" placeholder="Type to filter..." value="active-subscribers-q3" :clearable="true" hint="Click the clear icon (x) on the right to reset input." />
                </div>

                <!-- 5. Success State -->
                <div class="flex flex-col justify-start">
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-[11px] font-semibold text-zinc-400">Success State</span>
                        <span class="text-[10px] font-mono text-emerald-600 dark:text-emerald-400">state="success"</span>
                    </div>
                    <x-input name="demo_username_valid" label="Workspace Subdomain" value="acme-corp" state="success" hint="Subdomain is available and ready to use." />
                </div>

                <!-- 6. Error State -->
                <div class="flex flex-col justify-start">
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-[11px] font-semibold text-zinc-400">Error State</span>
                        <span class="text-[10px] font-mono text-rose-600 dark:text-rose-400">state="error"</span>
                    </div>
                    <x-input name="demo_promo_code" label="Voucher Promo Code" value="DISCOUNT-EXPIRED" state="error" errorMessage="Coupon voucher has expired or is invalid." />
                </div>
            </div>
        </x-card>

        <!-- Card 3: Modern Inputs with Built-in Icons (x-modern-input) -->
        <x-card title="Modern Inputs with Built-in Icons (&lt;x-modern-input&gt;)" subtitle="Modern inputs with preset prefix icons, currency auto-formatting, live counters, interactive tooltips, and required badges.">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 pt-2">
                <!-- 1. Modern Currency Input -->
                <div class="flex flex-col justify-start">
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-[11px] font-semibold text-zinc-400">Currency Mask + Icon</span>
                        <span class="text-[10px] font-mono text-emerald-600 dark:text-emerald-400">:isCurrency icon="currency"</span>
                    </div>
                    <x-modern-input name="demo_modern_budget" label="Campaign Budget (IDR)" icon="currency" :isCurrency="true" value="25000000" hint="Automatic currency formatting with AutoNumeric." />
                </div>

                <!-- 2. Official Work Email -->
                <div class="flex flex-col justify-start">
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-[11px] font-semibold text-zinc-400">Email + Required Tooltip</span>
                        <span class="text-[10px] font-mono text-emerald-600 dark:text-emerald-400">:required :tooltip</span>
                    </div>
                    <x-modern-input name="demo_modern_email" label="Official Work Email" type="email" icon="email" :required="true" tooltip="Official corporate email used for SSO and notifications." value="alexa.turner@enterprise.org" hint="Use your organization's official email domain." />
                </div>

                <!-- 3. Global Filter / Search -->
                <div class="flex flex-col justify-start">
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-[11px] font-semibold text-zinc-400">Search + Clear Button</span>
                        <span class="text-[10px] font-mono text-emerald-600 dark:text-emerald-400">:clearable icon="search"</span>
                    </div>
                    <x-modern-input name="demo_modern_search" label="Global Filter Tag" icon="search" value="invoices_paid_2025" :clearable="true" hint="Click the clear icon (x) to instantly reset search." />
                </div>

                <!-- 4. Admin Username -->
                <div class="flex flex-col justify-start">
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-[11px] font-semibold text-zinc-400">User Icon + Counter</span>
                        <span class="text-[10px] font-mono text-emerald-600 dark:text-emerald-400">:counter :maxlength</span>
                    </div>
                    <x-modern-input name="demo_modern_user" label="Admin Identity" icon="user" corner="Alphanumeric" :maxlength="30" :counter="true" value="andreas.developer" hint="Maximum 30 characters without spaces or special symbols." />
                </div>

                <!-- 5. WhatsApp Hotline -->
                <div class="flex flex-col justify-start">
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-[11px] font-semibold text-zinc-400">Phone Hotline</span>
                        <span class="text-[10px] font-mono text-emerald-600 dark:text-emerald-400">icon="phone"</span>
                    </div>
                    <x-modern-input name="demo_modern_phone" label="WhatsApp Hotline" icon="phone" placeholder="+62 812-3456-7890" value="+62 812 8899 0011" hint="Active mobile number for OTP and emergency notices." />
                </div>

                <!-- 6. Secure Server Endpoint -->
                <div class="flex flex-col justify-start">
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-[11px] font-semibold text-zinc-400">Verified SSL Host</span>
                        <span class="text-[10px] font-mono text-emerald-600 dark:text-emerald-400">state="success" icon="lock"</span>
                    </div>
                    <x-modern-input name="demo_modern_server" label="Encrypted Gateway Host" icon="lock" value="api.gateway.secure-corp.internal" state="success" hint="TLS v1.3 encrypted connection verified active." />
                </div>
            </div>
        </x-card>
    </section>

    <!-- 4. FLOATING LABEL INPUTS SECTION -->
    <section id="floating-inputs" class="space-y-6">
        <div class="flex items-center gap-2 border-b border-zinc-200/80 dark:border-zinc-800 pb-3">
            <div class="w-6 h-6 rounded-lg bg-sky-100 dark:bg-sky-950/60 flex items-center justify-center text-sky-600 dark:text-sky-400">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
            </div>
            <div>
                <div class="flex items-center gap-2">
                    <h2 class="text-sm font-bold text-zinc-900 dark:text-white">Floating Label Inputs</h2>
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">&lt;x-input-floating&gt;</span>
                </div>
                <p class="text-[11px] text-zinc-500">Material-style animated floating labels that rest inside the input and float upward on focus.</p>
            </div>
        </div>

        <!-- Card 1: Single-Line Floating Controls (All Uniform 50px Height) -->
        <x-card title="Floating Single-Line Inputs & Controls" subtitle="Text, email, currency mask, native select, basic password, and readonly floating inputs &mdash; all perfectly aligned with uniform 50px heights.">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 pt-2">
                <!-- 1. Text Floating -->
                <div class="flex flex-col justify-start">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-[11px] font-semibold text-zinc-400">Text Floating</span>
                        <span class="text-[10px] font-mono text-emerald-600 dark:text-emerald-400">&lt;x-input-floating&gt;</span>
                    </div>
                    <x-input-floating name="float_user" label="Username / Handle" value="andyian" :required="true" hint="Unique username handle within the system." />
                </div>

                <!-- 2. Email Floating -->
                <div class="flex flex-col justify-start">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-[11px] font-semibold text-zinc-400">Email Floating</span>
                        <span class="text-[10px] font-mono text-emerald-600 dark:text-emerald-400">type="email"</span>
                    </div>
                    <x-input-floating type="email" name="float_email" label="Contact Email" value="ian@basecode.dev" :required="true" hint="Active email address for correspondence." />
                </div>

                <!-- 3. Currency Floating -->
                <div class="flex flex-col justify-start">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-[11px] font-semibold text-zinc-400">Floating Currency</span>
                        <span class="text-[10px] font-mono text-emerald-600 dark:text-emerald-400">:isCurrency="true"</span>
                    </div>
                    <x-input-floating name="float_budget" label="Annual Budget (IDR)" value="75000000" :isCurrency="true" hint="Formatted numeric currency value." />
                </div>

                <!-- 4. Floating Select -->
                <div class="flex flex-col justify-start">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-[11px] font-semibold text-zinc-400">Floating Select</span>
                        <span class="text-[10px] font-mono text-emerald-600 dark:text-emerald-400">&lt;x-select-floating&gt;</span>
                    </div>
                    <x-select-floating name="float_country_showcase" label="Country of Operation" :options="['id' => 'Indonesia', 'us' => 'United States', 'sg' => 'Singapore', 'jp' => 'Japan']" value="id" :required="true" hint="Select primary office operational jurisdiction." />
                </div>

                <!-- 5. Password Floating (Standard) -->
                <div class="flex flex-col justify-start">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-[11px] font-semibold text-zinc-400">Password Floating</span>
                        <span class="text-[10px] font-mono text-emerald-600 dark:text-emerald-400">&lt;x-password-floating&gt;</span>
                    </div>
                    <x-password-floating name="float_pwd_basic" label="Standard Password" value="SuperSecure123!" hint="Minimum 8 characters combination." />
                </div>

                <!-- 6. Readonly / Locked Floating -->
                <div class="flex flex-col justify-start">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-[11px] font-semibold text-zinc-400">Readonly / Locked</span>
                        <span class="text-[10px] font-mono text-zinc-400">readonly</span>
                    </div>
                    <x-input-floating name="float_locked_id" label="System ID (Immutable)" value="SYS-98421-V3" readonly hint="Protected system-generated immutable identifier." />
                </div>
            </div>
        </x-card>

        <!-- Card 2: Password with Strength Meter & Multiline Textarea -->
        <x-card title="Floating Password Evaluation & Multiline Textarea" subtitle="Password with live complexity evaluation and multiline floating textarea for modal forms.">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 pt-2">
                <!-- Col 1: Password with Strength -->
                <div class="flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-[11px] font-semibold text-zinc-400">Password with Strength Meter</span>
                            <span class="text-[10px] font-mono text-emerald-600 dark:text-emerald-400">:strength="true"</span>
                        </div>
                        <x-password-floating name="float_pwd" label="Account Password" value="SuperSecure123!" :strength="true" />
                    </div>
                    <p class="mt-3 text-[11px] text-zinc-500">Live password complexity evaluation showing entropy, character variety, and strength label.</p>
                </div>

                <!-- Col 2: Multiline Floating Textarea -->
                <div class="flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-[11px] font-semibold text-zinc-400">Floating Label Textarea</span>
                            <span class="text-[10px] font-mono text-emerald-600 dark:text-emerald-400">&lt;x-textarea-floating&gt;</span>
                        </div>
                        <x-textarea-floating name="float_notes" label="Corporate Office Address" rows="3" value="Gedung Cyber 2 Lt. 18, Jl. H.R. Rasuna Said, Jakarta Selatan" />
                    </div>
                    <p class="mt-3 text-[11px] text-zinc-500">Floating label remains pinned at the top border when text is entered and smoothly reverts on clear.</p>
                </div>
            </div>
        </x-card>
    </section>

    <!-- 5. FORM GROUPS & INPUT ADDONS SECTION -->
    <section id="form-groups" class="space-y-6">
        <div class="flex items-center gap-2 border-b border-zinc-200/80 dark:border-zinc-800 pb-3">
            <div class="w-6 h-6 rounded-lg bg-teal-100 dark:bg-teal-950/60 flex items-center justify-center text-teal-600 dark:text-teal-400">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
            </div>
            <div>
                <div class="flex items-center gap-2">
                    <h2 class="text-sm font-bold text-zinc-900 dark:text-white">Form Groups & Input Addons</h2>
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">&lt;x-form-group&gt;</span>
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">&lt;x-input-group&gt;</span>
                </div>
                <p class="text-[11px] text-zinc-500">Connected input addons (prefixes, suffixes, currencies), embedded action buttons, and horizontal settings layouts.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- 1. Text & Symbol Addons -->
            <x-card title="Input Addons & Prepend/Append Groups" subtitle="Attached text prefixes, suffixes, currency symbols, and domain extensions via &lt;x-input-group&gt;.">
                <div class="space-y-4">
                    <x-input-group name="addon_url" label="Website URL" prefix="https://" suffix=".com" placeholder="yourcompany" description="Standard web protocol and top-level domain addon." />
                    
                    <x-input-group name="addon_handle" label="Developer Username" prefix="@" placeholder="octocat" description="Single-character symbol prefix." />
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <x-input-group name="addon_price" label="Monthly Subscription" prefix="$" suffix="/mo" placeholder="49.00" />
                        <x-input-group name="addon_weight" label="Package Weight" suffix="kg" placeholder="2.5" />
                    </div>

                    <x-input-group name="addon_currency" label="Currency Mask Addon" prefix="Rp" suffix=",00" value="7500000" :isCurrency="true" description="Input group integrated with auto-formatting currency mask." />
                </div>
            </x-card>

            <!-- 2. Attached Action Buttons -->
            <x-card title="Attached Action Buttons & Triggers" subtitle="Embed clickable buttons directly inside the input container for search, copy, or coupon codes.">
                <div class="space-y-4">
                    <x-input-group name="addon_search" label="Search Database" placeholder="Search orders, invoices, customers...">
                        <x-slot:buttonSlot>
                            <x-button size="sm" variant="primary" :solid="true" icon="search">
                                Search
                            </x-button>
                        </x-slot:buttonSlot>
                    </x-input-group>

                    <x-input-group name="addon_copy_token" label="API Secret Webhook Endpoint" value="https://api.myapp.io/v1/webhooks/whsec_89d3a7" readonly="true">
                        <x-slot:buttonSlot>
                            <x-button size="sm" variant="secondary" icon="check" @click="navigator.clipboard.writeText('https://api.myapp.io/v1/webhooks/whsec_89d3a7'); $dispatch('notify', { message: 'API Endpoint copied to clipboard!', type: 'success' })">
                                Copy
                            </x-button>
                        </x-slot:buttonSlot>
                    </x-input-group>

                    <x-input-group name="addon_coupon" label="Promo & Discount Code" placeholder="Enter coupon code (e.g. VIP2026)">
                        <x-slot:buttonSlot>
                            <x-button size="sm" variant="purple" :solid="true">
                                Apply Code
                            </x-button>
                        </x-slot:buttonSlot>
                    </x-input-group>

                    <x-input-group name="addon_disabled" label="Disabled Addon State" prefix="ID" value="SYS-99482" disabled="true" description="Connected addons inherit consistent disabled styling." />
                </div>
            </x-card>
        </div>

        <!-- 3. Horizontal Form Groups Layout (Settings / Profile style) -->
        <x-card title="Horizontal Form Layout (Settings Style)" subtitle="Responsive 2-column layout using :inline='true' with 1/3 label/description column and 2/3 control column.">
            <div class="divide-y divide-zinc-100 dark:divide-zinc-800">
                <x-form-group label="Company Name" name="org_name" description="Your legal registered business entity name." :inline="true" :required="true">
                    <x-input name="org_name" value="Acme Global Corporation" />
                </x-form-group>

                <x-form-group label="Workspace Domain" name="org_domain" description="The public subdomain where your team accesses the workspace." :inline="true" badge="Subdomain">
                    <x-input-group name="org_subdomain" prefix="https://" suffix=".cloudapp.io" value="acme-corp" />
                </x-form-group>

                <x-form-group label="Primary Admin" name="org_admin" description="Select the account owner for billing and security." :inline="true">
                    <x-select name="org_admin" :options="['admin1' => 'John Doe (Owner)', 'admin2' => 'Jane Smith (Billing Lead)', 'admin3' => 'Alex Rivera (DevOps Lead)']" selected="admin1" />
                </x-form-group>

                <x-form-group label="Security 2FA Policy" name="org_2fa" description="Enforce mandatory authenticator app validation for all members." :inline="true" badge="Required">
                    <x-toggle name="org_enforce_2fa" label="Enforce 2FA for all team members" :checked="true" />
                </x-form-group>

                <x-form-group label="Audit Log Retention" name="org_retention" description="Archived transaction and activity retention policy." :inline="true">
                    <div class="flex flex-wrap items-center gap-5 sm:gap-6 pt-0.5">
                        <x-radio name="org_retention_period" value="90" label="90 Days" :checked="true" />
                        <x-radio name="org_retention_period" value="180" label="180 Days" />
                        <x-radio name="org_retention_period" value="365" label="1 Year (Enterprise)" />
                    </div>
                </x-form-group>
            </div>
        </x-card>
    </section>

    <!-- 6. SELECT & DROPDOWNS SECTION -->
    <section id="select-inputs" class="space-y-6">
        <div class="flex items-center gap-2 border-b border-zinc-200/80 dark:border-zinc-800 pb-3">
            <div class="w-6 h-6 rounded-lg bg-indigo-100 dark:bg-indigo-950/60 flex items-center justify-center text-indigo-600 dark:text-indigo-400">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </div>
            <div>
                <div class="flex items-center gap-2">
                    <h2 class="text-sm font-bold text-zinc-900 dark:text-white">Select & Dropdown Controls</h2>
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">&lt;x-select&gt;</span>
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">&lt;x-modern-select&gt;</span>
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">&lt;x-select-floating&gt;</span>
                </div>
                <p class="text-[11px] text-zinc-500">Custom styled select dropdowns with dark mode option backgrounds and chevron indicators.</p>
            </div>
        </div>

        <!-- Row 1: Native & Modern Selects -->
        <x-card title="Native & Floating Selects" subtitle="Standard browser select controls with custom chevrons, icon prefixes, and floating labels.">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Standard Select -->
                <div class="flex flex-col justify-start">
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-[11px] font-semibold text-zinc-400">Standard Select</span>
                        <span class="text-[10px] font-mono text-emerald-600 dark:text-emerald-400">&lt;x-select&gt;</span>
                    </div>
                    <x-select name="demo_role" label="Assigned Role" :options="['admin' => 'Super Administrator', 'editor' => 'Editor & Manager', 'member' => 'Staff Member']" value="admin" />
                </div>

                <!-- Modern Select with Icon -->
                <div class="flex flex-col justify-start">
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-[11px] font-semibold text-zinc-400">With Icon Prefix</span>
                        <span class="text-[10px] font-mono text-emerald-600 dark:text-emerald-400">&lt;x-modern-select&gt;</span>
                    </div>
                    <x-modern-select name="demo_dept" label="Corporate Department" :options="['tech' => 'Engineering & Tech', 'design' => 'Product Design', 'marketing' => 'Marketing']" value="tech">
                        <x-slot:iconSlot>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </x-slot:iconSlot>
                    </x-modern-select>
                </div>

                <!-- Floating Select -->
                <div class="flex flex-col justify-start">
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-[11px] font-semibold text-zinc-400">Floating Select</span>
                        <span class="text-[10px] font-mono text-emerald-600 dark:text-emerald-400">&lt;x-select-floating&gt;</span>
                    </div>
                    <!-- Spacer matching outer label height of sibling selects (text-xs + mb-2 = 24px) -->
                    <div class="hidden sm:block h-6"></div>
                    <x-select-floating name="demo_country" label="Country of Operation" :options="['id' => 'Indonesia', 'us' => 'United States', 'sg' => 'Singapore', 'jp' => 'Japan']" value="id" />
                </div>
            </div>
        </x-card>

        <!-- Row 2: Multiple, Grouped & State Selects -->
        <x-card title="Multiple & Grouped Selects" subtitle="Standard browser multi-selection listboxes, optgroups, and state controls with zero wrappers.">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Multiple Select -->
                <div class="flex flex-col justify-start">
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-[11px] font-semibold text-zinc-400">Native Multi-Select</span>
                        <span class="text-[10px] font-mono text-emerald-600 dark:text-emerald-400">:multiple="true"</span>
                    </div>
                    <x-select name="demo_tech_stack" label="Tech Stack Specialization" :multiple="true" :options="['laravel' => 'Laravel Framework', 'tailwind' => 'Tailwind CSS', 'alpine' => 'Alpine.js', 'livewire' => 'Livewire v3', 'vite' => 'Vite Bundler', 'postgresql' => 'PostgreSQL']" :value="['laravel', 'tailwind']" />
                </div>

                <!-- Grouped Select with Optgroup -->
                <div class="flex flex-col justify-start">
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-[11px] font-semibold text-zinc-400">Grouped Options</span>
                        <span class="text-[10px] font-mono text-emerald-600 dark:text-emerald-400">&lt;optgroup&gt;</span>
                    </div>
                    <x-select name="demo_region_grouped" label="Cloud Region / Zone">
                        <optgroup label="Asia Pacific" class="font-bold text-zinc-500 dark:text-zinc-400">
                            <option value="sg" selected>Singapore (ap-southeast-1)</option>
                            <option value="id">Jakarta (ap-southeast-3)</option>
                            <option value="tokyo">Tokyo (ap-northeast-1)</option>
                        </optgroup>
                        <optgroup label="United States" class="font-bold text-zinc-500 dark:text-zinc-400">
                            <option value="us-east">US East (us-east-1)</option>
                            <option value="us-west">US West (us-west-2)</option>
                        </optgroup>
                        <optgroup label="Europe" class="font-bold text-zinc-500 dark:text-zinc-400">
                            <option value="eu-frankfurt">Frankfurt (eu-central-1)</option>
                            <option value="eu-london">London (eu-west-2)</option>
                        </optgroup>
                    </x-select>
                </div>

                <!-- Disabled / Readonly Select -->
                <div class="flex flex-col justify-start">
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-[11px] font-semibold text-zinc-400">Disabled State</span>
                        <span class="text-[10px] font-mono text-emerald-600 dark:text-emerald-400">disabled</span>
                    </div>
                    <x-select name="demo_locked_role" label="Account Type (Locked)" :options="['owner' => 'Workspace Owner (Immutable)', 'guest' => 'External Guest']" value="owner" disabled />
                </div>
            </div>
        </x-card>
    </section>

    <!-- 6. TEXTAREAS & TINYMCE RICH TEXT EDITOR SECTION -->
    <section id="textareas" class="space-y-6">
        <div class="flex items-center gap-2 border-b border-zinc-200/80 dark:border-zinc-800 pb-3">
            <div class="w-6 h-6 rounded-lg bg-teal-100 dark:bg-teal-950/60 flex items-center justify-center text-teal-600 dark:text-teal-400">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path></svg>
            </div>
            <div>
                <div class="flex items-center gap-2">
                    <h2 class="text-sm font-bold text-zinc-900 dark:text-white">Textareas & TinyMCE Rich Text Editor</h2>
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">&lt;x-textarea&gt;</span>
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">&lt;x-tinymce&gt;</span>
                </div>
                <p class="text-[11px] text-zinc-500">Standard multiline inputs, floating textareas, and the bundled TinyMCE v8 WYSIWYG editor.</p>
            </div>
        </div>

        <x-card title="Multiline Text Inputs" subtitle="Standard, modern with icon, and floating label textareas.">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Standard Textarea -->
                <div>
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-[11px] font-semibold text-zinc-400">Standard Textarea</span>
                        <span class="text-[10px] font-mono text-emerald-600 dark:text-emerald-400">&lt;x-textarea&gt;</span>
                    </div>
                    <x-textarea name="demo_bio" label="Biography" rows="3" value="Senior developer specializing in Laravel & modern Tailwind admin architectures." :required="true" tooltip="Ringkasan profil profesional yang tampil di kartu anggota tim." corner="Max 300 chars" :maxlength="300" :counter="true" hint="Maksimal 300 karakter, mendukung format teks sederhana." />
                </div>

                <!-- Modern Textarea with Icon -->
                <div>
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-[11px] font-semibold text-zinc-400">Icon Prefix</span>
                        <span class="text-[10px] font-mono text-emerald-600 dark:text-emerald-400">&lt;x-modern-textarea&gt;</span>
                    </div>
                    <x-modern-textarea name="demo_notes" label="Meeting Minutes" rows="3" value="Reviewed database indexing and Tailwind 4 theme performance.">
                        <x-slot:iconSlot>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                        </x-slot:iconSlot>
                    </x-modern-textarea>
                </div>

                <!-- Floating Label Textarea -->
                <div>
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-[11px] font-semibold text-zinc-400">Floating Textarea</span>
                        <span class="text-[10px] font-mono text-emerald-600 dark:text-emerald-400">&lt;x-textarea-floating&gt;</span>
                    </div>
                    <!-- Spacer matching outer label height of sibling textareas (text-xs + mb-2 = 24px) -->
                    <div class="hidden sm:block h-6"></div>
                    <x-textarea-floating name="demo_address" label="Company Physical Address" rows="3" value="Gedung Cyber 2 Lt. 18, Jl. H.R. Rasuna Said, Jakarta Selatan" />
                </div>
            </div>
        </x-card>

        <!-- TinyMCE Rich Text Editor Component -->
        <x-card title="TinyMCE WYSIWYG Rich Text Editor" subtitle="Bundled locally via NPM and Vite, fully reactive to dark mode toggle with table, code, image, and list plugins.">
            <x-slot:actions>
                <span class="px-2 py-0.5 rounded-md font-mono text-[10px] font-bold bg-zinc-100 dark:bg-zinc-800 text-emerald-600 dark:text-emerald-400">&lt;x-tinymce&gt;</span>
            </x-slot:actions>
            <div class="space-y-4">
                <x-tinymce name="demo_article_content" label="Article Content" height="280">
                    <h2>Welcome to the InForge Base Code Admin!</h2>
                    <p>This rich text area is powered by <strong>TinyMCE v8</strong>, compiled locally via Vite with zero external CDN dependencies.</p>
                    <ul>
                        <li>Supports code snippets, headers, lists, tables, and media formatting</li>
                        <li>Seamlessly switches between light and dark mode themes</li>
                        <li>Packaged cleanly as a reusable Blade component: <code>&lt;x-tinymce name="..." /&gt;</code></li>
                    </ul>
                </x-tinymce>

                <!-- Code Snippet -->
                <div class="p-3.5 rounded-xl bg-zinc-900 dark:bg-black text-zinc-300 font-mono text-xs overflow-x-auto">
                    <div class="flex items-center justify-between text-[11px] text-zinc-400 mb-2 border-b border-zinc-800 pb-1.5">
                        <span>TinyMCE Blade Component Usage</span>
                        <span class="text-emerald-400">copy-paste ready</span>
                    </div>
                    <pre class="text-zinc-300">&lt;x-tinymce name="content" label="Article Body" height="350"&gt;
    {!! $post->content ?? '' !!}
&lt;/x-tinymce&gt;</pre>
                </div>
            </div>
        </x-card>
    </section>

    <!-- 7. TOGGLES, SWITCHES, CHECKBOXES & RADIOS -->
    <section id="toggles" class="space-y-6">
        <div class="flex items-center gap-2 border-b border-zinc-200/80 dark:border-zinc-800 pb-3">
            <div class="w-6 h-6 rounded-lg bg-emerald-100 dark:bg-emerald-950/60 flex items-center justify-center text-emerald-600 dark:text-emerald-400">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
            </div>
            <div>
                <div class="flex items-center gap-2">
                    <h2 class="text-sm font-bold text-zinc-900 dark:text-white">Toggles, Checkboxes & Radios</h2>
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">&lt;x-toggle&gt;</span>
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">&lt;x-checkbox&gt;</span>
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">&lt;x-radio&gt;</span>
                </div>
                <p class="text-[11px] text-zinc-500">Form controls with descriptions, disabled states, and clickable card selection variants.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Toggles Card -->
            <x-card title="iOS-Style Toggle Switches" subtitle="Boolean switches with labels, hints, and card variants.">
                <div class="space-y-4">
                    <x-toggle name="demo_toggle_active" label="Account Active" description="Allow member to sign in." :checked="true" />
                    <x-toggle name="demo_toggle_2fa" label="Two-Factor Authentication" description="Enforce authenticator app at login." :checked="true" />
                    <x-toggle name="demo_toggle_email" label="Marketing Announcements" description="Receive occasional product updates." :checked="false" />
                    <div class="pt-2">
                        <x-toggle name="demo_toggle_card" label="Maintenance Mode" description="Disable public storefront access." :checked="false" variant="card" />
                    </div>
                </div>
            </x-card>

            <!-- Checkboxes Card -->
            <x-card title="Modern Checkbox Components" subtitle="Multi-selection items supporting descriptions, primary theme, and card mode.">
                <div class="space-y-3.5">
                    <x-checkbox name="demo_cb_email" label="Daily Email Digest" description="Summary of team activities at 08:00 AM." :checked="true" />
                    <x-checkbox name="demo_cb_sms" label="Critical Security SMS" description="Instant alert for unauthorized attempts." :checked="true" />
                    <x-checkbox name="demo_cb_locked" label="Beta AI Copilot (Locked)" description="Available exclusively on Enterprise tier." :disabled="true" />
                    <div class="pt-1.5">
                        <x-checkbox name="demo_cb_card" label="Developer API Access" description="Generate and rotate personal API tokens." badge="API v3" variant="card" :checked="true" />
                    </div>
                </div>
            </x-card>

            <!-- Radio Buttons Card -->
            <x-card title="Radio Selection Components" subtitle="Single-choice option sets with primary theme and custom card highlights.">
                <div class="space-y-3">
                    <x-radio name="demo_billing" value="monthly" label="Monthly Billing Cycle" description="Billed on the 1st day of every month." :checked="true" />
                    <x-radio name="demo_billing" value="annual" label="Annual Billing Cycle" description="Billed yearly with a 20% discount applied." />
                    <div class="pt-1.5 space-y-2">
                        <x-radio name="demo_plan" value="pro" label="Pro Tier ($29/mo)" description="Full analytics, unlimited seats & live support." badge="Popular" variant="card" :checked="true" />
                        <x-radio name="demo_plan" value="enterprise" label="Enterprise Dedicated" description="Custom contracts, SLA guarantee & SSO." badge="Custom" variant="card" />
                    </div>
                </div>
            </x-card>
        </div>

        <!-- Dedicated Accent Color Variants Showcase -->
        <x-card title="Accent Color Variants Showcase" subtitle="Vibrant theme color choices (:color='primary|blue|purple|rose|amber') with custom accent tokens and high contrast.">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Checkbox Colors -->
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold uppercase tracking-wider text-zinc-700 dark:text-zinc-300">Checkbox Color Palette</span>
                        <span class="text-[10px] font-mono text-zinc-400">color="..."</span>
                    </div>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-2.5">
                        <div class="p-3 rounded-xl border border-emerald-200/70 dark:border-emerald-900/50 bg-emerald-50/40 dark:bg-emerald-950/20 text-center flex flex-col items-center justify-center gap-1">
                            <x-checkbox name="demo_cb_primary" label="Primary" color="primary" :checked="true" />
                            <span class="text-[10px] font-mono font-bold text-emerald-600 dark:text-emerald-400">#059669</span>
                        </div>
                        <div class="p-3 rounded-xl border border-blue-200/70 dark:border-blue-900/50 bg-blue-50/40 dark:bg-blue-950/20 text-center flex flex-col items-center justify-center gap-1">
                            <x-checkbox name="demo_cb_blue" label="Blue" color="blue" :checked="true" />
                            <span class="text-[10px] font-mono font-bold text-blue-600 dark:text-blue-400">#2563eb</span>
                        </div>
                        <div class="p-3 rounded-xl border border-purple-200/70 dark:border-purple-900/50 bg-purple-50/40 dark:bg-purple-950/20 text-center flex flex-col items-center justify-center gap-1">
                            <x-checkbox name="demo_cb_purple" label="Purple" color="purple" :checked="true" />
                            <span class="text-[10px] font-mono font-bold text-purple-600 dark:text-purple-400">#9333ea</span>
                        </div>
                        <div class="p-3 rounded-xl border border-rose-200/70 dark:border-rose-900/50 bg-rose-50/40 dark:bg-rose-950/20 text-center flex flex-col items-center justify-center gap-1">
                            <x-checkbox name="demo_cb_rose" label="Rose" color="rose" :checked="true" />
                            <span class="text-[10px] font-mono font-bold text-rose-600 dark:text-rose-400">#e11d48</span>
                        </div>
                        <div class="p-3 rounded-xl border border-amber-200/70 dark:border-amber-900/50 bg-amber-50/40 dark:bg-amber-950/20 text-center flex flex-col items-center justify-center gap-1">
                            <x-checkbox name="demo_cb_amber" label="Amber" color="amber" :checked="true" />
                            <span class="text-[10px] font-mono font-bold text-amber-600 dark:text-amber-400">#f59e0b</span>
                        </div>
                    </div>
                </div>

                <!-- Radio Colors -->
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold uppercase tracking-wider text-zinc-700 dark:text-zinc-300">Radio Option Color Palette</span>
                        <span class="text-[10px] font-mono text-zinc-400">color="..."</span>
                    </div>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-2.5">
                        <div class="p-3 rounded-xl border border-emerald-200/70 dark:border-emerald-900/50 bg-emerald-50/40 dark:bg-emerald-950/20 text-center flex flex-col items-center justify-center gap-1">
                            <x-radio name="palette_rc_1" value="p1" label="Primary" color="primary" :checked="true" />
                            <span class="text-[10px] font-mono font-bold text-emerald-600 dark:text-emerald-400">#059669</span>
                        </div>
                        <div class="p-3 rounded-xl border border-blue-200/70 dark:border-blue-900/50 bg-blue-50/40 dark:bg-blue-950/20 text-center flex flex-col items-center justify-center gap-1">
                            <x-radio name="palette_rc_2" value="p2" label="Blue" color="blue" :checked="true" />
                            <span class="text-[10px] font-mono font-bold text-blue-600 dark:text-blue-400">#2563eb</span>
                        </div>
                        <div class="p-3 rounded-xl border border-purple-200/70 dark:border-purple-900/50 bg-purple-50/40 dark:bg-purple-950/20 text-center flex flex-col items-center justify-center gap-1">
                            <x-radio name="palette_rc_3" value="p3" label="Purple" color="purple" :checked="true" />
                            <span class="text-[10px] font-mono font-bold text-purple-600 dark:text-purple-400">#9333ea</span>
                        </div>
                        <div class="p-3 rounded-xl border border-rose-200/70 dark:border-rose-900/50 bg-rose-50/40 dark:bg-rose-950/20 text-center flex flex-col items-center justify-center gap-1">
                            <x-radio name="palette_rc_4" value="p4" label="Rose" color="rose" :checked="true" />
                            <span class="text-[10px] font-mono font-bold text-rose-600 dark:text-rose-400">#e11d48</span>
                        </div>
                        <div class="p-3 rounded-xl border border-amber-200/70 dark:border-amber-900/50 bg-amber-50/40 dark:bg-amber-950/20 text-center flex flex-col items-center justify-center gap-1">
                            <x-radio name="palette_rc_5" value="p5" label="Amber" color="amber" :checked="true" />
                            <span class="text-[10px] font-mono font-bold text-amber-600 dark:text-amber-400">#f59e0b</span>
                        </div>
                    </div>
                </div>
            </div>
        </x-card>
    </section>

    <!-- 8. DATE & FILE UPLOADS SECTION -->
    <section id="uploads" class="space-y-6">
        <div class="flex items-center gap-2 border-b border-zinc-200/80 dark:border-zinc-800 pb-3">
            <div class="w-6 h-6 rounded-lg bg-rose-100 dark:bg-rose-950/60 flex items-center justify-center text-rose-600 dark:text-rose-400">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            </div>
            <div>
                <div class="flex items-center gap-2">
                    <h2 class="text-sm font-bold text-zinc-900 dark:text-white">Date Pickers & File Uploads</h2>
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">&lt;x-datetime&gt;</span>
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">&lt;x-filepond&gt;</span>
                </div>
                <p class="text-[11px] text-zinc-500">ISO-compliant datetime pickers and drag-and-drop FilePond uploader with live image preview.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Datetime Picker -->
            <x-card title="Datetime Picker" subtitle="Native ISO 8601 datetime selector with dark mode styling.">
                <x-datetime name="demo_scheduled_at" label="Event Launch Schedule" value="2026-09-08 17:30" />
                
                <div class="mt-4 p-3 rounded-xl bg-zinc-50 dark:bg-zinc-800/40 border border-zinc-100 dark:border-zinc-800 text-xs text-zinc-500">
                    Automatically converts standard Carbon dates (`Y-m-d H:i:s`) into `datetime-local` formats.
                </div>
            </x-card>

            <!-- FilePond Drag & Drop Upload -->
            <x-card title="FilePond File & Image Uploader" subtitle="Drag-and-drop file upload with preview, crop, and validation.">
                <x-filepond name="demo_avatar" label="Profile Avatar Upload" :isAvatar="false" hint="Supports JPG, PNG, WebP up to 2MB" />
            </x-card>
        </div>
    </section>

    <!-- 9. CARDS & CONTAINERS SECTION -->
    <section id="cards" class="space-y-6">
        <div class="flex items-center gap-2 border-b border-zinc-200/80 dark:border-zinc-800 pb-3">
            <div class="w-6 h-6 rounded-lg bg-purple-100 dark:bg-purple-950/60 flex items-center justify-center text-purple-600 dark:text-purple-400">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
            </div>
            <div>
                <div class="flex items-center gap-2">
                    <h2 class="text-sm font-bold text-zinc-900 dark:text-white">Cards & Metric Panels</h2>
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">&lt;x-card&gt;</span>
                </div>
                <p class="text-[11px] text-zinc-500">Container panels with header actions, title, subtitle, and footer slots.</p>
            </div>
        </div>

        <x-card title="Metric & Stat Card Widgets" subtitle="Dashboard overview metric card layout with real-time indicators.">
            <x-slot:actions>
                <x-button variant="secondary" size="sm" icon="refresh">Refresh Metrics</x-button>
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
                    <p class="text-[11px] font-bold uppercase tracking-wider text-zinc-400">Server Logs</p>
                    <div class="flex items-baseline justify-between mt-1">
                        <span class="text-xl font-extrabold text-zinc-900 dark:text-white">342</span>
                        <x-badge variant="info" size="sm">Normal</x-badge>
                    </div>
                </div>

                <div class="p-4 rounded-xl bg-zinc-50 dark:bg-zinc-800/40 border border-zinc-100 dark:border-zinc-800">
                    <p class="text-[11px] font-bold uppercase tracking-wider text-zinc-400">Active Roles</p>
                    <div class="flex items-baseline justify-between mt-1">
                        <span class="text-xl font-extrabold text-zinc-900 dark:text-white">8</span>
                        <x-badge variant="purple" size="sm">Configured</x-badge>
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

    <!-- 10. ALERTS & NOTIFICATIONS SECTION -->
    <section id="alerts" class="space-y-6">
        <div class="flex items-center gap-2 border-b border-zinc-200/80 dark:border-zinc-800 pb-3">
            <div class="w-6 h-6 rounded-lg bg-rose-100 dark:bg-rose-950/60 flex items-center justify-center text-rose-600 dark:text-rose-400">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
            </div>
            <div>
                <div class="flex items-center gap-2">
                    <h2 class="text-sm font-bold text-zinc-900 dark:text-white">Alerts & Toast Events</h2>
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">&lt;x-alert&gt;</span>
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">&lt;x-toast&gt;</span>
                </div>
                <p class="text-[11px] text-zinc-500">Dismissible notification banners and Alpine.js / SweetAlert toast event triggers.</p>
            </div>
        </div>

        <!-- Alert Banners: Outline vs Solid High-Contrast -->
        <x-card title="Alert Banners: Outline vs Solid High-Contrast" subtitle="Choose between soft badge aesthetic or punchy solid high-contrast alerts via :solid='true'.">
            <div class="space-y-6">
                <!-- Group 1: Outline / Soft Banners -->
                <div>
                    <div class="flex items-center gap-2 mb-3">
                        <span class="text-xs font-bold text-zinc-900 dark:text-zinc-100">1. Outline / Soft Alert Style</span>
                        <span class="px-2 py-0.5 rounded text-[10px] font-mono text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/60 border border-emerald-200/60 dark:border-emerald-800/60">default / style="outline"</span>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <x-alert variant="success" title="Success Alert" dismissible>
                            Your changes have been saved to the database successfully.
                        </x-alert>

                        <x-alert variant="info" title="Information Note" dismissible>
                            System maintenance is scheduled for Sunday at 02:00 UTC.
                        </x-alert>

                        <x-alert variant="warning" title="Security Warning" dismissible>
                            Two-Factor Authentication is currently recommended for all administrator accounts.
                        </x-alert>

                        <x-alert variant="danger" title="Error Encountered" dismissible>
                            Unable to connect to third-party payment gateway. Please check your credentials.
                        </x-alert>

                        <div class="md:col-span-2">
                            <x-alert variant="dark" title="Dark System Notice" dismissible>
                                Audit logging is currently active for all administrative actions on this cluster.
                            </x-alert>
                        </div>
                    </div>
                </div>

                <!-- Group 2: Solid High-Contrast Banners -->
                <div class="pt-6 border-t border-zinc-100 dark:border-zinc-800">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="text-xs font-bold text-zinc-900 dark:text-zinc-100">2. Solid High-Contrast Style</span>
                        <span class="px-2 py-0.5 rounded text-[10px] font-mono text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/60 border border-emerald-200/60 dark:border-emerald-800/60">:solid="true"</span>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <x-alert variant="success" :solid="true" title="Solid Success" dismissible>
                            Record created and indexed with zero schema validation errors.
                        </x-alert>

                        <x-alert variant="info" :solid="true" title="Solid Information" dismissible>
                            New API documentation version v3.0 has been deployed.
                        </x-alert>

                        <x-alert variant="warning" :solid="true" title="Solid Warning" dismissible>
                            Server disk space utilization reached 88% capacity.
                        </x-alert>

                        <x-alert variant="danger" :solid="true" title="Solid Critical Error" dismissible>
                            Payment webhook failed with HTTP 504 Gateway Timeout.
                        </x-alert>

                        <div class="md:col-span-2">
                            <x-alert variant="dark" :solid="true" title="Solid Dark Notice" dismissible>
                                Production maintenance window will commence at 00:00 midnight.
                            </x-alert>
                        </div>
                    </div>
                </div>
            </div>
        </x-card>

        <!-- Interactive Toast Triggers -->
        <x-card title="Interactive Real-Time Toast Triggers" subtitle="Click any button below to trigger soft or solid high-contrast toast notifications.">
            <div class="space-y-5">
                <!-- Soft Toasts -->
                <div>
                    <div class="text-[11px] font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wider mb-2.5">
                        Soft / Outline Toast Notifications
                    </div>
                    <div class="flex flex-wrap items-center gap-2.5">
                        <x-button variant="primary" icon="check"
                            @click="window.dispatchEvent(new CustomEvent('notify', { detail: { message: 'Item created successfully!', type: 'success', solid: false } }))">
                            Soft Success Toast
                        </x-button>

                        <x-button variant="danger" icon="trash"
                            @click="window.dispatchEvent(new CustomEvent('notify', { detail: { message: 'Failed to delete record!', type: 'error', solid: false } }))">
                            Soft Error Toast
                        </x-button>

                        <x-button variant="warning" icon="exclamation-circle"
                            @click="window.dispatchEvent(new CustomEvent('notify', { detail: { message: 'Warning: Session expiring in 5 minutes.', type: 'warning', solid: false } }))">
                            Soft Warning Toast
                        </x-button>

                        <x-button variant="info" icon="information-circle"
                            @click="window.dispatchEvent(new CustomEvent('notify', { detail: { message: 'Background batch job completed.', type: 'info', solid: false } }))">
                            Soft Info Toast
                        </x-button>
                    </div>
                </div>

                <!-- Solid High-Contrast Toasts -->
                <div class="pt-4 border-t border-zinc-100 dark:border-zinc-800">
                    <div class="text-[11px] font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wider mb-2.5">
                        Solid High-Contrast Toast Notifications (:solid="true")
                    </div>
                    <div class="flex flex-wrap items-center gap-2.5">
                        <x-button variant="primary" :solid="true" icon="check"
                            @click="window.dispatchEvent(new CustomEvent('notify', { detail: { message: 'High-contrast changes saved successfully!', type: 'success', solid: true } }))">
                            Solid Success
                        </x-button>

                        <x-button variant="danger" :solid="true" icon="trash"
                            @click="window.dispatchEvent(new CustomEvent('notify', { detail: { message: 'Critical error: Database transaction aborted!', type: 'error', solid: true } }))">
                            Solid Error
                        </x-button>

                        <x-button variant="warning" :solid="true" icon="exclamation-circle"
                            @click="window.dispatchEvent(new CustomEvent('notify', { detail: { message: 'High priority alert: Rate limit threshold at 95%!', type: 'warning', solid: true } }))">
                            Solid Warning
                        </x-button>

                        <x-button variant="info" :solid="true" icon="information-circle"
                            @click="window.dispatchEvent(new CustomEvent('notify', { detail: { message: 'Real-time telemetry stream synchronized.', type: 'info', solid: true } }))">
                            Solid Info
                        </x-button>

                        <x-button variant="dark" :solid="true" icon="information-circle"
                            @click="window.dispatchEvent(new CustomEvent('notify', { detail: { message: 'System maintenance scheduled.', type: 'dark', solid: true } }))">
                            Solid Dark
                        </x-button>
                    </div>
                </div>

                <!-- Modal Demo -->
                <div class="pt-4 border-t border-zinc-100 dark:border-zinc-800 flex items-center justify-between">
                    <div>
                        <div class="text-xs font-bold text-zinc-800 dark:text-zinc-200">Confirmation Dialog Demo</div>
                        <div class="text-[11px] text-zinc-500">Test the unified SweetAlert2 confirmation dialog modal.</div>
                    </div>
                    <x-button variant="secondary" icon="fa fa-bell"
                        @click="window.dispatchEvent(new CustomEvent('open-delete-modal', { detail: { action: '#' } }))">
                        Test SweetAlert Confirm Modal
                    </x-button>
                </div>
            </div>
        </x-card>
    </section>

    <!-- 11. INTERACTIVE MODALS & DIALOGS SECTION -->
    <section id="modals" class="space-y-6">
        <div class="flex items-center gap-2 border-b border-zinc-200/80 dark:border-zinc-800 pb-3">
            <div class="w-6 h-6 rounded-lg bg-indigo-100 dark:bg-indigo-950/60 flex items-center justify-center text-indigo-600 dark:text-indigo-400">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"></path></svg>
            </div>
            <div>
                <div class="flex items-center gap-2">
                    <h2 class="text-sm font-bold text-zinc-900 dark:text-white">Interactive Modals & Dialogs</h2>
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">&lt;x-modal&gt;</span>
                </div>
                <p class="text-[11px] text-zinc-500">Accessible dialog windows powered by Alpine.js with backdrop blur, customizable sizes, and action footers.</p>
            </div>
        </div>

        <x-card title="Modal Showcase & Triggers" subtitle="Click any button below to preview standard confirmation modals, interactive form modals, or size variants.">
            <div class="flex flex-wrap items-center gap-3">
                <!-- Trigger 1: Standard Info Modal -->
                <x-button variant="primary" :solid="true" icon="information-circle"
                    @click="window.openModal('modal-info')">
                    Open Info Dialog (lg)
                </x-button>

                <!-- Trigger 2: Form Modal -->
                <x-button variant="secondary" icon="pencil"
                    @click="window.openModal('modal-form')">
                    Open Form Modal (md)
                </x-button>

                <!-- Trigger 3: Danger Confirm Modal -->
                <x-button variant="danger" :solid="true" icon="trash"
                    @click="window.openModal('modal-danger')">
                    Open Danger Dialog (sm)
                </x-button>

                <!-- Trigger 4: Extra Large Modal -->
                <x-button variant="purple" icon="arrows-pointing-out"
                    @click="window.openModal('modal-xl')">
                    Large Content Dialog (2xl)
                </x-button>
            </div>

            <!-- Modals Declarations -->
            <!-- 1. Info Modal (Default lg) -->
            <x-modal id="modal-info" title="System Cluster Overview" subtitle="Operational health metrics across regions." icon="info" size="lg">
                <div class="space-y-3">
                    <p>All microservices are functioning normally with 99.98% uptime in the past 30 days. No anomalous spikes detected.</p>
                    <div class="p-3.5 rounded-xl bg-zinc-50 dark:bg-zinc-800/50 border border-zinc-200/60 dark:border-zinc-700/60 text-xs space-y-1">
                        <div class="flex justify-between font-medium"><span>API Gateway</span><span class="text-emerald-600 font-bold">Healthy (14ms)</span></div>
                        <div class="flex justify-between font-medium"><span>Primary PostgreSQL</span><span class="text-emerald-600 font-bold">Connected (3 connections)</span></div>
                        <div class="flex justify-between font-medium"><span>Redis Cache</span><span class="text-emerald-600 font-bold">Active (4.2MB used)</span></div>
                    </div>
                </div>

                <x-slot:footer>
                    <x-button variant="secondary" @click="window.closeModal('modal-info')">Close</x-button>
                    <x-button variant="primary" :solid="true" @click="window.closeModal('modal-info')">Got it</x-button>
                </x-slot:footer>
            </x-modal>

            <!-- 2. Form Modal (size md) -->
            <x-modal id="modal-form" title="Invite Team Member" subtitle="Send an invitation link to collaborate on this project." size="md">
                <form class="space-y-4" @submit.prevent="window.closeModal('modal-form'); window.dispatchEvent(new CustomEvent('notify', { detail: { message: 'Invitation email dispatched!', type: 'success', solid: true } }))">
                    <x-input name="invite_email" type="email" label="Email Address" placeholder="colleague@company.com" required />
                    <x-select name="invite_role" label="Project Role" :options="['editor' => 'Project Editor', 'reviewer' => 'Code Reviewer', 'admin' => 'Administrator']" value="editor" />

                    <div class="bg-zinc-50/70 dark:bg-zinc-800/30 border-t border-zinc-100 dark:border-zinc-800 -mx-6 -mb-5 px-6 py-3.5 mt-6 flex items-center justify-end gap-3 rounded-b-2xl">
                        <x-button type="button" variant="secondary" @click="window.closeModal('modal-form')">Cancel</x-button>
                        <x-button type="submit" variant="primary" :solid="true" icon="paper-airplane">Send Invite</x-button>
                    </div>
                </form>
            </x-modal>

            <!-- 3. Danger Modal (size sm) -->
            <x-modal id="modal-danger" title="Permanently Delete Workspace?" subtitle="This action cannot be undone." icon="trash" size="sm">
                <p class="text-xs text-zinc-500 dark:text-zinc-400">
                    Are you sure you wish to delete the staging workspace? All associated databases, containers, and deployment snapshots will be erased immediately.
                </p>

                <x-slot:footer>
                    <x-button variant="secondary" @click="window.closeModal('modal-danger')">Cancel</x-button>
                    <x-button variant="danger" :solid="true" icon="trash" @click="window.closeModal('modal-danger'); window.dispatchEvent(new CustomEvent('notify', { detail: { message: 'Workspace removed permanently.', type: 'error', solid: true } }))">
                        Yes, Delete Workspace
                    </x-button>
                </x-slot:footer>
            </x-modal>

            <!-- 4. XL Modal (size 2xl) -->
            <x-modal id="modal-xl" title="API Terms of Service & Privacy Policy" subtitle="Version 3.2 &mdash; Effective as of September 2026" size="2xl">
                <div class="space-y-4 max-h-[360px] overflow-y-auto pr-2 text-xs leading-relaxed text-zinc-600 dark:text-zinc-300">
                    <p class="font-bold text-zinc-900 dark:text-white text-sm">1. Introduction & Acceptance</p>
                    <p>By accessing or using our developer APIs, administration console, and platform services, you agree to be bound by these Terms of Service. If you do not agree to these terms, do not access or use the services.</p>

                    <p class="font-bold text-zinc-900 dark:text-white text-sm">2. Security & Token Responsibility</p>
                    <p>You are solely responsible for maintaining the confidentiality of any API tokens, credentials, or private signing keys provisioned to your account. You agree to notify our security operations center immediately in the event of any unauthorized disclosure or security breach.</p>

                    <p class="font-bold text-zinc-900 dark:text-white text-sm">3. Data Integrity & Rate Limits</p>
                    <p>Our infrastructure enforces dynamic rate limiting based on your tier subscription. Excessive automated polling, abusive traffic patterns, or security bypass attempts will result in automated IP throttling or immediate revocation of access tokens.</p>
                </div>

                <x-slot:footer>
                    <x-button variant="secondary" @click="window.closeModal('modal-xl')">Decline</x-button>
                    <x-button variant="primary" :solid="true" @click="window.closeModal('modal-xl')">Accept Terms</x-button>
                </x-slot:footer>
            </x-modal>
        </x-card>
    </section>

    <!-- 12. STATS & KPI METRICS SECTION -->
    <section id="stats" class="space-y-6">
        <div class="flex items-center gap-2 border-b border-zinc-200/80 dark:border-zinc-800 pb-3">
            <div class="w-6 h-6 rounded-lg bg-emerald-100 dark:bg-emerald-950/60 flex items-center justify-center text-emerald-600 dark:text-emerald-400">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
            </div>
            <div>
                <div class="flex items-center gap-2">
                    <h2 class="text-sm font-bold text-zinc-900 dark:text-white">KPI & Stat Metric Cards</h2>
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">&lt;x-stat-card&gt;</span>
                </div>
                <p class="text-[11px] text-zinc-500">Executive summary metrics with trend direction indicators, period comparisons, and progress thresholds.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
            <x-stat-card title="Total Revenue" value="Rp 148.820.000" trend="+18.4%" trendLabel="vs last month" icon="dollar" color="primary" />
            <x-stat-card title="Active Subscribers" value="2,840" trend="+12.5%" trendLabel="vs last month" icon="users" color="blue" badge="Pro" />
            <x-stat-card title="Fulfillment Queue" value="148 Orders" trend="+24" trendLabel="awaiting dispatch" icon="shopping-cart" color="amber" badge="Action Req" />
            <x-stat-card title="Cluster CPU Load" value="78.2%" trend="-3.5%" trendLabel="peak at 14:00" icon="server" color="rose" :progress="78" progressLabel="Target Utilization" />
        </div>
    </section>

    <!-- 13. TABS & SEGMENTED FILTERS SECTION -->
    <section id="tabs" class="space-y-6">
        <div class="flex items-center gap-2 border-b border-zinc-200/80 dark:border-zinc-800 pb-3">
            <div class="w-6 h-6 rounded-lg bg-sky-100 dark:bg-sky-950/60 flex items-center justify-center text-sky-600 dark:text-sky-400">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
            </div>
            <div>
                <div class="flex items-center gap-2">
                    <h2 class="text-sm font-bold text-zinc-900 dark:text-white">Tabs & Segmented Controls</h2>
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">&lt;x-tabs&gt;</span>
                </div>
                <p class="text-[11px] text-zinc-500">Interactive tab navigation supporting modern pills segmented style and classic underline borders.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- 1. Pills Variant -->
            <x-card title="Segmented Pills Navigation" subtitle="Default pill badge container variant='pills' for quick status filters.">
                <x-tabs :tabs="[
                    ['id' => 'tab_all', 'label' => 'All Invoices', 'badge' => '128'],
                    ['id' => 'tab_paid', 'label' => 'Paid & Settled', 'badge' => '104'],
                    ['id' => 'tab_pending', 'label' => 'Pending Review', 'badge' => '18'],
                    ['id' => 'tab_archived', 'label' => 'Archived', 'badge' => '6'],
                ]" active="tab_all">
                    <div x-show="activeTab === 'tab_all'" class="p-4 rounded-xl bg-zinc-50 dark:bg-zinc-800/40 border border-zinc-100 dark:border-zinc-800 text-xs text-zinc-600 dark:text-zinc-300">
                        <span class="font-bold text-zinc-900 dark:text-white block mb-1">Showing All Invoices (128 Records)</span>
                        Displaying full transaction history across all payment gateways and enterprise billing contracts.
                    </div>
                    <div x-show="activeTab === 'tab_paid'" class="p-4 rounded-xl bg-emerald-50/50 dark:bg-emerald-950/20 border border-emerald-200/60 dark:border-emerald-800/60 text-xs text-emerald-800 dark:text-emerald-300">
                        <span class="font-bold block mb-1">Settled Invoices (104 Records)</span>
                        All confirmed wire transfers, credit card payments, and automatic renewals.
                    </div>
                    <div x-show="activeTab === 'tab_pending'" class="p-4 rounded-xl bg-amber-50/50 dark:bg-amber-950/20 border border-amber-200/60 dark:border-amber-800/60 text-xs text-amber-800 dark:text-amber-300">
                        <span class="font-bold block mb-1">Pending Invoices (18 Records)</span>
                        Invoices awaiting customer payment proof confirmation or bank transfer webhook.
                    </div>
                    <div x-show="activeTab === 'tab_archived'" class="p-4 rounded-xl bg-zinc-100 dark:bg-zinc-800 text-xs text-zinc-600 dark:text-zinc-400">
                        <span class="font-bold block mb-1">Archived Invoices (6 Records)</span>
                        Historical statements archived beyond the 3-year standard retention period.
                    </div>
                </x-tabs>
            </x-card>

            <!-- 2. Underline Border Variant -->
            <x-card title="Underline Border Navigation" subtitle="Classic settings tab navigation with active accent indicators via variant='underline'.">
                <x-tabs :tabs="[
                    ['id' => 'set_general', 'label' => 'General Info'],
                    ['id' => 'set_security', 'label' => 'Security & 2FA', 'badge' => '2FA Active'],
                    ['id' => 'set_billing', 'label' => 'Billing & Tier'],
                    ['id' => 'set_api', 'label' => 'API Webhooks'],
                ]" active="set_general" variant="underline">
                    <div x-show="activeTab === 'set_general'" class="p-4 rounded-xl bg-zinc-50 dark:bg-zinc-800/40 border border-zinc-100 dark:border-zinc-800 text-xs text-zinc-600 dark:text-zinc-300 space-y-2">
                        <span class="font-bold text-zinc-900 dark:text-white block">General Workspace Settings</span>
                        Configure primary organization name, corporate legal domain, and public support contact.
                    </div>
                    <div x-show="activeTab === 'set_security'" class="p-4 rounded-xl bg-zinc-50 dark:bg-zinc-800/40 border border-zinc-100 dark:border-zinc-800 text-xs text-zinc-600 dark:text-zinc-300 space-y-2">
                        <span class="font-bold text-zinc-900 dark:text-white block">Security & Access Management</span>
                        Enforce mandatory FIDO2 hardware tokens or TOTP authenticator validation across all staff seats.
                    </div>
                    <div x-show="activeTab === 'set_billing'" class="p-4 rounded-xl bg-zinc-50 dark:bg-zinc-800/40 border border-zinc-100 dark:border-zinc-800 text-xs text-zinc-600 dark:text-zinc-300 space-y-2">
                        <span class="font-bold text-zinc-900 dark:text-white block">Billing & Plan Tier</span>
                        Current subscription: <strong class="text-emerald-600 dark:text-emerald-400">Enterprise Cloud ($499/mo)</strong> renewed automatically.
                    </div>
                    <div x-show="activeTab === 'set_api'" class="p-4 rounded-xl bg-zinc-50 dark:bg-zinc-800/40 border border-zinc-100 dark:border-zinc-800 text-xs text-zinc-600 dark:text-zinc-300 space-y-2">
                        <span class="font-bold text-zinc-900 dark:text-white block">Webhooks & Outbound Events</span>
                        Configure automated dispatch of `invoice.paid` and `member.joined` payload endpoints.
                    </div>
                </x-tabs>
            </x-card>
        </div>
    </section>

    <!-- 14. DATA TABLES, DROPDOWNS & EMPTY STATE SECTION -->
    <section id="tables" class="space-y-6">
        <div class="flex items-center gap-2 border-b border-zinc-200/80 dark:border-zinc-800 pb-3">
            <div class="w-6 h-6 rounded-lg bg-violet-100 dark:bg-violet-950/60 flex items-center justify-center text-violet-600 dark:text-violet-400">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            </div>
            <div>
                <div class="flex items-center gap-2">
                    <h2 class="text-sm font-bold text-zinc-900 dark:text-white">Data Tables & Dropdown Action Menus</h2>
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">&lt;x-table&gt;</span>
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">&lt;x-dropdown&gt;</span>
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">&lt;x-empty-state&gt;</span>
                </div>
                <p class="text-[11px] text-zinc-500">Enterprise data table layout with row hover, avatar badges, status indicators, and popover dropdown action triggers.</p>
            </div>
        </div>

        <!-- 1. Interactive Data Table -->
        <x-table>
            <x-slot:header>
                <tr>
                    <th class="py-3.5 px-4 w-12 text-center">
                        <input type="checkbox" class="w-4 h-4 rounded border-zinc-300 dark:border-zinc-700 text-emerald-600 focus:ring-emerald-500">
                    </th>
                    <th class="py-3.5 px-4 font-bold">User & Account</th>
                    <th class="py-3.5 px-4 font-bold">Role & Permissions</th>
                    <th class="py-3.5 px-4 font-bold">Status</th>
                    <th class="py-3.5 px-4 font-bold">Last Activity</th>
                    <th class="py-3.5 px-4 font-bold text-right">Actions</th>
                </tr>
            </x-slot:header>

            <!-- Row 1 -->
            <tr class="group">
                <td class="py-3.5 px-4 text-center">
                    <input type="checkbox" class="w-4 h-4 rounded border-zinc-300 dark:border-zinc-700 text-emerald-600 focus:ring-emerald-500">
                </td>
                <td class="py-3.5 px-4">
                    <div class="flex items-center gap-3">
                        <x-avatar name="Sarah Jenkins" size="sm" status="online" />
                        <div>
                            <span class="font-bold text-zinc-900 dark:text-white block">Sarah Jenkins</span>
                            <span class="text-xs text-zinc-500">sarah.j@enterprise.io</span>
                        </div>
                    </div>
                </td>
                <td class="py-3.5 px-4">
                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-purple-100 dark:bg-purple-950/80 text-purple-700 dark:text-purple-300 border border-purple-200/60 dark:border-purple-800/60">
                        Super Admin
                    </span>
                </td>
                <td class="py-3.5 px-4">
                    <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 dark:bg-emerald-950/80 text-emerald-700 dark:text-emerald-300">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Active
                    </span>
                </td>
                <td class="py-3.5 px-4 text-xs text-zinc-500">
                    2 minutes ago
                </td>
                <td class="py-3.5 px-4 text-right">
                    <x-dropdown>
                        <x-dropdown-item icon="<svg class='w-4 h-4' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M15 12a3 3 0 11-6 0 3 3 0 016 0z'></path><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z'></path></svg>">View Profile</x-dropdown-item>
                        <x-dropdown-item icon="<svg class='w-4 h-4' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z'></path></svg>">Edit Role</x-dropdown-item>
                        <x-dropdown-item :divider="true" />
                        <x-dropdown-item :danger="true" icon="<svg class='w-4 h-4' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16'></path></svg>">Revoke Access</x-dropdown-item>
                    </x-dropdown>
                </td>
            </tr>

            <!-- Row 2 -->
            <tr class="group">
                <td class="py-3.5 px-4 text-center">
                    <input type="checkbox" class="w-4 h-4 rounded border-zinc-300 dark:border-zinc-700 text-emerald-600 focus:ring-emerald-500">
                </td>
                <td class="py-3.5 px-4">
                    <div class="flex items-center gap-3">
                        <x-avatar name="Michael Chang" size="sm" status="away" />
                        <div>
                            <span class="font-bold text-zinc-900 dark:text-white block">Michael Chang</span>
                            <span class="text-xs text-zinc-500">m.chang@enterprise.io</span>
                        </div>
                    </div>
                </td>
                <td class="py-3.5 px-4">
                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-100 dark:bg-blue-950/80 text-blue-700 dark:text-blue-300 border border-blue-200/60 dark:border-blue-800/60">
                        Lead Developer
                    </span>
                </td>
                <td class="py-3.5 px-4">
                    <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 dark:bg-emerald-950/80 text-emerald-700 dark:text-emerald-300">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Active
                    </span>
                </td>
                <td class="py-3.5 px-4 text-xs text-zinc-500">
                    1 hour ago
                </td>
                <td class="py-3.5 px-4 text-right">
                    <x-dropdown>
                        <x-dropdown-item>View Profile</x-dropdown-item>
                        <x-dropdown-item>Edit Role</x-dropdown-item>
                        <x-dropdown-item :divider="true" />
                        <x-dropdown-item :danger="true">Revoke Access</x-dropdown-item>
                    </x-dropdown>
                </td>
            </tr>

            <!-- Row 3 -->
            <tr class="group">
                <td class="py-3.5 px-4 text-center">
                    <input type="checkbox" class="w-4 h-4 rounded border-zinc-300 dark:border-zinc-700 text-emerald-600 focus:ring-emerald-500">
                </td>
                <td class="py-3.5 px-4">
                    <div class="flex items-center gap-3">
                        <x-avatar name="Amara Patel" size="sm" status="offline" />
                        <div>
                            <span class="font-bold text-zinc-900 dark:text-white block">Amara Patel</span>
                            <span class="text-xs text-zinc-500">amara.p@agency.com</span>
                        </div>
                    </div>
                </td>
                <td class="py-3.5 px-4">
                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-300 border border-zinc-200/60 dark:border-zinc-700/60">
                        External Auditor
                    </span>
                </td>
                <td class="py-3.5 px-4">
                    <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 dark:bg-amber-950/80 text-amber-700 dark:text-amber-300">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Pending 2FA
                    </span>
                </td>
                <td class="py-3.5 px-4 text-xs text-zinc-500">
                    3 days ago
                </td>
                <td class="py-3.5 px-4 text-right">
                    <x-dropdown>
                        <x-dropdown-item>Resend 2FA Email</x-dropdown-item>
                        <x-dropdown-item>Modify Expiry</x-dropdown-item>
                        <x-dropdown-item :divider="true" />
                        <x-dropdown-item :danger="true">Revoke Invite</x-dropdown-item>
                    </x-dropdown>
                </td>
            </tr>

            <x-slot:footer>
                <span>Showing <strong>1</strong> to <strong>3</strong> of <strong>48</strong> users</span>
                <div class="flex items-center gap-2">
                    <x-button size="sm" variant="secondary" :disabled="true">Previous</x-button>
                    <x-button size="sm" variant="secondary">Next</x-button>
                </div>
            </x-slot:footer>
        </x-table>

        <!-- 2. Empty State Card -->
        <x-card title="Empty State Component" subtitle="Consistent fallback state when queries or filters return no matching records.">
            <x-empty-state 
                icon="search"
                title="No transactions found" 
                description="We couldn't locate any matching payment transactions for the selected date range. Try clearing filters or creating a manual charge."
                actionText="Create Transaction"
                secondaryActionText="Reset Search Filters" />
        </x-card>
    </section>

    <!-- 15. AVATARS & SKELETON LOADERS SECTION -->
    <section id="avatars" class="space-y-6">
        <div class="flex items-center gap-2 border-b border-zinc-200/80 dark:border-zinc-800 pb-3">
            <div class="w-6 h-6 rounded-lg bg-pink-100 dark:bg-pink-950/60 flex items-center justify-center text-pink-600 dark:text-pink-400">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            </div>
            <div>
                <div class="flex items-center gap-2">
                    <h2 class="text-sm font-bold text-zinc-900 dark:text-white">Avatars, Stacks & Skeleton Loaders</h2>
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">&lt;x-avatar&gt;</span>
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">&lt;x-avatar-group&gt;</span>
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">&lt;x-skeleton&gt;</span>
                </div>
                <p class="text-[11px] text-zinc-500">Avatar initials with deterministic gradients, presence indicators, overlapping teams, and animated skeleton loaders.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Avatars & Groups -->
            <x-card title="Avatars & Overlapping Team Stacks" subtitle="Dynamic deterministic gradient generation based on user name, status dot indicators, and stacks.">
                <div class="space-y-6">
                    <div>
                        <span class="text-xs font-bold uppercase tracking-wider text-zinc-400 block mb-3">Sizes & Shapes</span>
                        <div class="flex flex-wrap items-center gap-3">
                            <x-avatar name="Jessica Alba" size="xs" status="online" />
                            <x-avatar name="David Beckham" size="sm" status="away" />
                            <x-avatar name="Elena Rostova" size="md" status="online" />
                            <x-avatar name="Marcus Aurelius" size="lg" status="busy" />
                            <x-avatar name="Kofi Annan" size="xl" status="offline" shape="rounded" />
                        </div>
                    </div>

                    <div class="pt-4 border-t border-zinc-100 dark:border-zinc-800">
                        <span class="text-xs font-bold uppercase tracking-wider text-zinc-400 block mb-3">Overlapping Team Group Stack</span>
                        <x-avatar-group excess="6">
                            <x-avatar name="Alice Wonderland" size="md" />
                            <x-avatar name="Bob Builder" size="md" />
                            <x-avatar name="Charlie Brown" size="md" />
                            <x-avatar name="Diana Prince" size="md" />
                        </x-avatar-group>
                    </div>
                </div>
            </x-card>

            <!-- Skeleton Loaders -->
            <x-card title="Animated Skeleton Loaders" subtitle="Smooth pulsing placeholders (:type='text|avatar|card|button') for asynchronous data loading states.">
                <div class="space-y-5">
                    <div>
                        <span class="text-xs font-bold uppercase tracking-wider text-zinc-400 block mb-2.5">Text & Paragraph Lines</span>
                        <x-skeleton type="text" :lines="3" />
                    </div>

                    <div class="pt-4 border-t border-zinc-100 dark:border-zinc-800">
                        <span class="text-xs font-bold uppercase tracking-wider text-zinc-400 block mb-2.5">Avatar & Metadata Skeleton</span>
                        <div class="flex items-center gap-3">
                            <x-skeleton type="avatar" size="md" />
                            <div class="space-y-2 flex-1">
                                <x-skeleton type="text" :lines="2" />
                            </div>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-zinc-100 dark:border-zinc-800 flex items-center gap-3">
                        <x-skeleton type="button" />
                        <x-skeleton type="button" class="w-32" />
                    </div>
                </div>
            </x-card>
        </div>
    </section>

    <!-- 16. BREADCRUMBS & STEPPERS SECTION -->
    <section id="navigation" class="space-y-6">
        <div class="flex items-center gap-2 border-b border-zinc-200/80 dark:border-zinc-800 pb-3">
            <div class="w-6 h-6 rounded-lg bg-blue-100 dark:bg-blue-950/60 flex items-center justify-center text-blue-600 dark:text-blue-400">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </div>
            <div>
                <div class="flex items-center gap-2">
                    <h2 class="text-sm font-bold text-zinc-900 dark:text-white">Breadcrumbs & Steppers</h2>
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">&lt;x-breadcrumb&gt;</span>
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">&lt;x-stepper&gt;</span>
                </div>
                <p class="text-[11px] text-zinc-500">Hierarchical page location trails and multi-step form progress indicators.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Breadcrumbs Card -->
            <x-card title="Breadcrumb Navigation Trails" subtitle="Clean hierarchical route breadcrumbs with Home root icon and chevron separators.">
                <div class="space-y-4">
                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-zinc-400 block mb-2">Two-Level Navigation</span>
                        <x-breadcrumb :items="[
                            ['label' => 'Users Management', 'url' => '#']
                        ]" />
                    </div>

                    <div class="pt-3 border-t border-zinc-100 dark:border-zinc-800">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-zinc-400 block mb-2">Deep Nested Page Trail</span>
                        <x-breadcrumb :items="[
                            ['label' => 'Organizations', 'url' => '#'],
                            ['label' => 'Acme Corp', 'url' => '#'],
                            ['label' => 'Audit Security Logs', 'url' => null]
                        ]" />
                    </div>
                </div>
            </x-card>

            <!-- Stepper Card -->
            <x-card title="Multi-Step Onboarding Stepper" subtitle="Workflow stage progress tracking (:status='complete|current|upcoming').">
                <div class="py-2">
                    <x-stepper :steps="[
                        ['title' => 'Account Details', 'description' => 'Email & credentials', 'status' => 'complete'],
                        ['title' => 'Workspace Setup', 'description' => 'Domain & team config', 'status' => 'current'],
                        ['title' => 'Billing & Review', 'description' => 'Plan confirmation', 'status' => 'upcoming'],
                    ]" />
                </div>
            </x-card>
        </div>
    </section>

    <!-- 17. TIMELINE & ACTIVITY FEED SECTION -->
    <section id="timeline" class="space-y-6">
        <div class="flex items-center gap-2 border-b border-zinc-200/80 dark:border-zinc-800 pb-3">
            <div class="w-6 h-6 rounded-lg bg-emerald-100 dark:bg-emerald-950/60 flex items-center justify-center text-emerald-600 dark:text-emerald-400">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <div class="flex items-center gap-2">
                    <h2 class="text-sm font-bold text-zinc-900 dark:text-white">Timeline & Activity Feeds</h2>
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">&lt;x-timeline&gt;</span>
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">&lt;x-timeline-item&gt;</span>
                </div>
                <p class="text-[11px] text-zinc-500">Visual event stream with connector lines, status indicator badges, and actor metadata.</p>
            </div>
        </div>

        <x-card title="System Audit & Activity Feed" subtitle="Real-time chronological events matching the built-in activity log engine.">
            <x-timeline>
                <x-timeline-item 
                    title="Invoice #INV-2026-089 Settled via Stripe" 
                    time="10 minutes ago" 
                    color="primary"
                    badge="Payment"
                    description="Payment of Rp 14.500.000 was successfully processed and receipt dispatched to customer.">
                    <div class="p-2.5 rounded-lg bg-zinc-50 dark:bg-zinc-800/40 border border-zinc-100 dark:border-zinc-800 font-mono text-[11px] text-zinc-600 dark:text-zinc-400">
                        Transaction ID: tx_sec_99182a47 &bull; Fee: Rp 45.000
                    </div>
                </x-timeline-item>

                <x-timeline-item 
                    title="New Member Invited to Engineering Team" 
                    time="1 hour ago" 
                    color="blue"
                    badge="Team"
                    description="Alex Rivera (alex.r@enterprise.io) was provisioned with Developer permissions by Super Admin Sarah Jenkins." />

                <x-timeline-item 
                    title="Two-Factor Authentication Enforced" 
                    time="Yesterday at 16:45" 
                    color="purple"
                    badge="Security"
                    description="Organization security policy updated to require TOTP verification for all production cluster deployments." />

                <x-timeline-item 
                    title="API Rate Limit Warning Triggered" 
                    time="2 days ago" 
                    color="amber"
                    badge="Warning"
                    description="Webhook endpoint exceeded 80% quota threshold (8,240 calls in 1 hour). Automated throttling applied." />
            </x-timeline>
        </x-card>
    </section>

    <!-- 18. ACCORDION & SLIDE-OVER DRAWER SECTION -->
    <section id="collapsible" class="space-y-6">
        <div class="flex items-center gap-2 border-b border-zinc-200/80 dark:border-zinc-800 pb-3">
            <div class="w-6 h-6 rounded-lg bg-amber-100 dark:bg-amber-950/60 flex items-center justify-center text-amber-600 dark:text-amber-400">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
            </div>
            <div>
                <div class="flex items-center gap-2">
                    <h2 class="text-sm font-bold text-zinc-900 dark:text-white">Accordions & Slide-Over Drawer</h2>
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">&lt;x-accordion&gt;</span>
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">&lt;x-slideover&gt;</span>
                </div>
                <p class="text-[11px] text-zinc-500">Smooth collapsible panels and teleported offcanvas slide-over drawer for auxiliary actions.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-start">
            <!-- Accordion Card -->
            <x-card title="Interactive Accordion Panels" subtitle="Collapsible accordion sections with rotating chevrons and Alpine.js animations.">
                <x-accordion>
                    <x-accordion-item title="How are automated database backups managed?" :open="true">
                        Daily automated snapshots are captured at 02:00 UTC and replicated across 3 geo-redundant storage regions with 30-day point-in-time recovery support.
                    </x-accordion-item>
                    <x-accordion-item title="Can custom webhook signature headers be rotated?" badge="Enterprise">
                        Yes, navigate to Organization Settings &gt; Webhooks and select Rotate HMAC Secret. Both existing and new signing secrets will remain valid for a 24-hour grace window.
                    </x-accordion-item>
                    <x-accordion-item title="What happens during peak API rate limit exceeded?">
                        Incoming requests return an HTTP 429 Too Many Requests response with a standard `Retry-After` header indicating when requests will be resumed.
                    </x-accordion-item>
                </x-accordion>
            </x-card>

            <!-- Slide-Over Trigger Card -->
            <x-card title="Slide-Over Offcanvas Drawer" subtitle="Teleported side drawer sliding in from the right viewport edge without leaving the page.">
                <div class="p-6 rounded-2xl bg-zinc-50 dark:bg-zinc-800/40 border border-zinc-200/60 dark:border-zinc-800 text-center space-y-3">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-100 dark:bg-emerald-950/80 text-emerald-600 dark:text-emerald-400 mx-auto flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-zinc-900 dark:text-white">Slide-Over Side Panel</h4>
                        <p class="text-xs text-zinc-500 max-w-sm mx-auto mt-1">Perfect for filtering tables, viewing audit metadata, or reviewing member profiles in place.</p>
                    </div>
                    <div class="pt-2">
                        <x-button variant="primary" :solid="true" icon="eye" @click="window.openSlideover('drawer-demo')">
                            Open Slide-Over Drawer
                        </x-button>
                    </div>
                </div>

                {{-- The Slideover Component --}}
                <x-slideover id="drawer-demo" title="User Profile & Access Details" subtitle="Viewing record for Sarah Jenkins (#USR-8902)">
                    <div class="space-y-5">
                        <div class="flex items-center gap-4 p-4 rounded-xl bg-zinc-50 dark:bg-zinc-800/50 border border-zinc-100 dark:border-zinc-800">
                            <x-avatar name="Sarah Jenkins" size="lg" status="online" />
                            <div>
                                <h4 class="text-sm font-bold text-zinc-900 dark:text-white">Sarah Jenkins</h4>
                                <span class="text-xs text-zinc-500">Super Administrator &bull; DevOps Lead</span>
                                <div class="flex items-center gap-2 mt-1.5">
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 dark:bg-emerald-950/80 text-emerald-700 dark:text-emerald-300">Active</span>
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-purple-100 dark:bg-purple-950/80 text-purple-700 dark:text-purple-300">2FA Verified</span>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-3 text-xs">
                            <span class="font-bold uppercase tracking-wider text-zinc-400 block text-[10px]">Assigned Permissions</span>
                            <div class="grid grid-cols-2 gap-2">
                                <span class="p-2 rounded-lg bg-zinc-100 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-300">Users: Full Access</span>
                                <span class="p-2 rounded-lg bg-zinc-100 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-300">Billing: Modify</span>
                                <span class="p-2 rounded-lg bg-zinc-100 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-300">Logs: View & Prune</span>
                                <span class="p-2 rounded-lg bg-zinc-100 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-300">API: Generate Keys</span>
                            </div>
                        </div>

                        <div class="space-y-2 text-xs">
                            <span class="font-bold uppercase tracking-wider text-zinc-400 block text-[10px]">Session Logs</span>
                            <div class="p-3 rounded-xl bg-zinc-50 dark:bg-zinc-800/40 border border-zinc-100 dark:border-zinc-800 space-y-1">
                                <div class="flex items-center justify-between font-medium">
                                    <span class="text-zinc-800 dark:text-zinc-200">Chrome on macOS (103.24.12.9)</span>
                                    <span class="text-[10px] text-emerald-600 font-bold">Current</span>
                                </div>
                                <p class="text-[11px] text-zinc-400">Jakarta, Indonesia &bull; Last seen 2 mins ago</p>
                            </div>
                        </div>
                    </div>

                    <x-slot:footer>
                        <x-button variant="secondary" size="sm" @click="window.closeSlideover('drawer-demo')">Close</x-button>
                        <x-button variant="primary" :solid="true" size="sm" icon="check" @click="window.closeSlideover('drawer-demo'); window.dispatchEvent(new CustomEvent('notify', { detail: { message: 'Profile saved.', type: 'success' } }))">
                            Save Changes
                        </x-button>
                    </x-slot:footer>
                </x-slideover>
            </x-card>
        </div>
    </section>

    <!-- 19. PROGRESS BARS & DESCRIPTION LISTS SECTION -->
    <section id="progress" class="space-y-6">
        <div class="flex items-center gap-2 border-b border-zinc-200/80 dark:border-zinc-800 pb-3">
            <div class="w-6 h-6 rounded-lg bg-teal-100 dark:bg-teal-950/60 flex items-center justify-center text-teal-600 dark:text-teal-400">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
            </div>
            <div>
                <div class="flex items-center gap-2">
                    <h2 class="text-sm font-bold text-zinc-900 dark:text-white">Progress Bars & Description Lists</h2>
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">&lt;x-progress&gt;</span>
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">&lt;x-description-list&gt;</span>
                </div>
                <p class="text-[11px] text-zinc-500">Visual progress indicators with stripe patterns and 2-column key-value receipt metadata layouts.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-start">
            <!-- Progress Bars Card -->
            <x-card title="Linear Progress Indicators" subtitle="Supports custom accent colors, height sizes (:size='sm|md|lg'), striped patterns, and animations.">
                <div class="space-y-4">
                    <x-progress label="Monthly Cloud Storage Quota" :value="68" color="primary" />
                    <x-progress label="API Monthly Bandwidth (84.2 GB / 100 GB)" :value="84" color="blue" :striped="true" />
                    <x-progress label="Staging Server CPU Load (High Alert)" :value="92" color="rose" :striped="true" :animated="true" />
                    <x-progress label="Deployment Pipeline Build" :value="45" color="purple" size="lg" />
                </div>
            </x-card>

            <!-- Description List Card -->
            <x-card title="Key-Value Description List" subtitle="Structured two-column metadata list with alternating row tints, ideal for Show/Detail views.">
                <x-description-list :striped="true">
                    <x-description-item label="Transaction ID" value="TXN-2026-90481-BCA" />
                    <x-description-item label="Payment Gateway">
                        <div class="flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            <span class="font-bold text-zinc-900 dark:text-white">BCA Virtual Account</span>
                        </div>
                    </x-description-item>
                    <x-description-item label="Total Settled" value="Rp 24.500.000 (IDR)" />
                    <x-description-item label="Billing Recipient" value="PT. Teknologi Nusantara Abadi" />
                    <x-description-item label="Tax Receipt Status">
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 dark:bg-emerald-950/80 text-emerald-700 dark:text-emerald-300">
                            E-Faktur Generated
                        </span>
                    </x-description-item>
                </x-description-list>
            </x-card>
        </div>
    </section>

    <!-- 20. MICRO-COMPONENTS & DEVELOPER HELPERS SECTION -->
    <section id="micro" class="space-y-6">
        <div class="flex items-center gap-2 border-b border-zinc-200/80 dark:border-zinc-800 pb-3">
            <div class="w-6 h-6 rounded-lg bg-violet-100 dark:bg-violet-950/60 flex items-center justify-center text-violet-600 dark:text-violet-400">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
            </div>
            <div>
                <div class="flex flex-wrap items-center gap-2">
                    <h2 class="text-sm font-bold text-zinc-900 dark:text-white">Micro-Components & Developer Helpers</h2>
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">&lt;x-copy-button&gt;</span>
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">&lt;x-tooltip&gt;</span>
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">&lt;x-code-block&gt;</span>
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">&lt;x-divider&gt;</span>
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">&lt;x-rating&gt;</span>
                </div>
                <p class="text-[11px] text-zinc-500">Lightweight developer utilities for clipboard copying, floating tooltips, syntax code blocks, dividers, and star ratings.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-start">
            <!-- Tooltips & Copy Buttons -->
            <x-card title="Tooltips & Copy-to-Clipboard Buttons" subtitle="Zero-dependency micro-tooltips with arrow anchors and clipboard buttons with animated checkmarks.">
                <div class="space-y-6">
                    <!-- Tooltip Positions -->
                    <div>
                        <span class="text-[11px] font-semibold text-zinc-400 uppercase tracking-wider block mb-3">Directional Tooltips (Hover / Focus)</span>
                        <div class="flex flex-wrap items-center gap-3">
                            <x-tooltip text="Tooltip pinned to Top" position="top">
                                <x-button variant="secondary" size="sm">Top Tooltip</x-button>
                            </x-tooltip>

                            <x-tooltip text="Tooltip pinned to Bottom" position="bottom">
                                <x-button variant="secondary" size="sm">Bottom Tooltip</x-button>
                            </x-tooltip>

                            <x-tooltip text="Tooltip pinned to Left" position="left">
                                <x-button variant="secondary" size="sm">Left Tooltip</x-button>
                            </x-tooltip>

                            <x-tooltip text="Tooltip pinned to Right" position="right">
                                <x-button variant="secondary" size="sm">Right Tooltip</x-button>
                            </x-tooltip>
                        </div>
                    </div>

                    <!-- Copy Buttons -->
                    <div>
                        <span class="text-[11px] font-semibold text-zinc-400 uppercase tracking-wider block mb-3">Copy to Clipboard Variants</span>
                        <div class="flex flex-wrap items-center gap-3">
                            <x-copy-button text="https://basecode.dev/v3/api/webhook" variant="outline" label="Copy Endpoint" />
                            <x-copy-button text="npm i @intech/base-admin" variant="secondary" label="Copy NPM Command" />
                            <x-copy-button text="sk_live_948210398410294" variant="solid" size="sm" label="Copy Secret" />
                        </div>
                    </div>

                    <!-- Token Snippet with Embedded Copy -->
                    <div>
                        <span class="text-[11px] font-semibold text-zinc-400 uppercase tracking-wider block mb-2">Embedded in Token Box</span>
                        <div class="flex items-center justify-between p-2.5 rounded-xl bg-zinc-50 dark:bg-zinc-800/80 border border-zinc-200/80 dark:border-zinc-700/80">
                            <div class="flex items-center gap-2 overflow-hidden mr-2">
                                <span class="px-1.5 py-0.5 rounded text-[10px] font-bold uppercase bg-emerald-100 dark:bg-emerald-950/80 text-emerald-700 dark:text-emerald-300 shrink-0">Bearer</span>
                                <code class="text-xs font-mono text-zinc-700 dark:text-zinc-300 truncate">eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...984210</code>
                            </div>
                            <x-copy-button text="eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkFuZHkgSWFuIn0.984210" size="xs" variant="ghost" />
                        </div>
                    </div>
                </div>
            </x-card>

            <!-- Terminal Code Blocks -->
            <x-card title="Terminal & Code Blocks" subtitle="Mac-style dark terminal window with language badges, line numbers, and embedded copy functionality.">
                <div class="space-y-4">
                    <x-code-block title="Terminal Quickstart" language="BASH">
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm install && npm run build
php artisan serve</x-code-block>

                    <x-code-block title="composer.json snippet" language="JSON" :lineNumbers="true">{
  "name": "ianandilimawan/laravel-generator",
  "type": "project",
  "description": "Base Code Admin v3.0",
  "require": {
    "php": "^8.2",
    "laravel/framework": "^12.0",
    "livewire/livewire": "^3.5"
  }
}</x-code-block>
                </div>
            </x-card>

            <!-- Dividers & Separators -->
            <x-card title="Dividers & Visual Separators" subtitle="Horizontal rule dividers with center text, badges, and icon markers in solid or dashed styles.">
                <div class="space-y-4">
                    <x-divider label="OR CONTINUE WITH" />

                    <div class="grid grid-cols-2 gap-3">
                        <button type="button" class="flex items-center justify-center gap-2 py-2 px-3 rounded-xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-xs font-semibold text-zinc-700 dark:text-zinc-200 hover:bg-zinc-50 dark:hover:bg-zinc-750 transition-colors">
                            <svg class="w-4 h-4" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/></svg>
                            Google
                        </button>
                        <button type="button" class="flex items-center justify-center gap-2 py-2 px-3 rounded-xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-xs font-semibold text-zinc-700 dark:text-zinc-200 hover:bg-zinc-50 dark:hover:bg-zinc-750 transition-colors">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/></svg>
                            GitHub
                        </button>
                    </div>

                    <x-divider badge="NEW RELEASES" />
                    <x-divider icon="lock" label="SECURE 256-BIT ENCRYPTION" :dashed="true" />
                    <x-divider align="left" label="SECTION SEPARATOR" />
                </div>
            </x-card>

            <!-- Star Rating System -->
            <x-card title="Interactive Star Rating System" subtitle="Accessible star rating with interactive hover states, readonly scores, sizes, and color themes.">
                <div class="space-y-5">
                    <!-- Interactive Rating -->
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-xs font-semibold text-zinc-700 dark:text-zinc-300">Interactive Rating (Click to Rate)</span>
                            <span class="text-[10px] font-mono text-emerald-600 dark:text-emerald-400">interactive</span>
                        </div>
                        <x-rating name="customer_feedback" :value="4" :showValue="true" size="lg" />
                    </div>

                    <!-- Readonly with Score -->
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-xs font-semibold text-zinc-700 dark:text-zinc-300">Readonly Rating with Value Display</span>
                            <span class="text-[10px] font-mono text-zinc-400">readonly</span>
                        </div>
                        <x-rating :value="5" :readonly="true" :showValue="true" />
                    </div>

                    <!-- Colors & Sizes -->
                    <div>
                        <span class="text-[11px] font-semibold text-zinc-400 uppercase tracking-wider block mb-2.5">Sizes & Color Themes</span>
                        <div class="space-y-2.5">
                            <div class="flex items-center gap-3">
                                <span class="text-xs text-zinc-500 w-16">Rose (sm):</span>
                                <x-rating :value="4" size="sm" color="rose" :readonly="true" />
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="text-xs text-zinc-500 w-16">Blue (md):</span>
                                <x-rating :value="3" size="md" color="blue" :readonly="true" />
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="text-xs text-zinc-500 w-16">Amber (lg):</span>
                                <x-rating :value="5" size="lg" color="amber" :readonly="true" />
                            </div>
                        </div>
                    </div>
                </div>
            </x-card>
        </div>
    </section>
</div>
@endsection

@push('scripts')
    @vite('resources/js/form-libs.js')
@endpush

