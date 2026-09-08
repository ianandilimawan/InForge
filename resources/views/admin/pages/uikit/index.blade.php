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
                    v3.0 Design System
                </span>
                <span class="text-xs text-zinc-400">&bull;</span>
                <span class="text-xs text-zinc-500 dark:text-zinc-400">Reusable Primitives & UI Kit</span>
            </div>
            <h1 class="text-base sm:text-lg md:text-xl font-bold tracking-tight text-zinc-900 dark:text-white">
                UI Components Showcase
            </h1>
            <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">
                Comprehensive directory of every Blade component, input control, button, badge, and notification ready for your CRUDs.
            </p>
        </div>
        <div class="flex items-center gap-2">
            <x-button variant="secondary" icon="arrow-left" href="{{ route('admin.dashboard') }}">
                Dashboard
            </x-button>
            <x-button variant="primary" icon="check" @click="window.dispatchEvent(new CustomEvent('notify', { detail: { message: 'InForge UI Kit ready for rapid prototyping!', type: 'success' } }))">
                Quick Test
            </x-button>
        </div>
    </div>

    <!-- Sticky Navigation Sub-Header -->
    <div class="flex items-center gap-2 overflow-x-auto pb-1 text-xs no-scrollbar">
        <a href="#buttons" class="px-3 py-1.5 rounded-xl font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 hover:text-emerald-600 dark:hover:text-emerald-400 border border-zinc-200/60 dark:border-zinc-700/60 transition-colors shrink-0">
            Buttons
        </a>
        <a href="#badges" class="px-3 py-1.5 rounded-xl font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 hover:text-emerald-600 dark:hover:text-emerald-400 border border-zinc-200/60 dark:border-zinc-700/60 transition-colors shrink-0">
            Badges & Statuses
        </a>
        <a href="#text-inputs" class="px-3 py-1.5 rounded-xl font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 hover:text-emerald-600 dark:hover:text-emerald-400 border border-zinc-200/60 dark:border-zinc-700/60 transition-colors shrink-0">
            Text & Number Inputs
        </a>
        <a href="#select-inputs" class="px-3 py-1.5 rounded-xl font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 hover:text-emerald-600 dark:hover:text-emerald-400 border border-zinc-200/60 dark:border-zinc-700/60 transition-colors shrink-0">
            Select & Dropdowns
        </a>
        <a href="#textarea-inputs" class="px-3 py-1.5 rounded-xl font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 hover:text-emerald-600 dark:hover:text-emerald-400 border border-zinc-200/60 dark:border-zinc-700/60 transition-colors shrink-0">
            Textareas & Multiline
        </a>
        <a href="#toggles" class="px-3 py-1.5 rounded-xl font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 hover:text-emerald-600 dark:hover:text-emerald-400 border border-zinc-200/60 dark:border-zinc-700/60 transition-colors shrink-0">
            Toggles & Radios
        </a>
        <a href="#uploads" class="px-3 py-1.5 rounded-xl font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 hover:text-emerald-600 dark:hover:text-emerald-400 border border-zinc-200/60 dark:border-zinc-700/60 transition-colors shrink-0">
            Date & File Uploaders
        </a>
        <a href="#cards" class="px-3 py-1.5 rounded-xl font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 hover:text-emerald-600 dark:hover:text-emerald-400 border border-zinc-200/60 dark:border-zinc-700/60 transition-colors shrink-0">
            Cards
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
                <div class="flex items-center gap-2">
                    <h2 class="text-sm font-bold text-zinc-900 dark:text-white">Buttons</h2>
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">&lt;x-button&gt;</span>
                </div>
                <p class="text-[11px] text-zinc-500">Pill badges with subtle translucent borders, micro-shadows, and smooth hover states.</p>
            </div>
        </div>

        <!-- Color Variants -->
        <x-card title="Color Variants" subtitle="Standard soft pill styling harmonized with the navbar action buttons.">
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

    <!-- 3. TEXT & NUMBER INPUTS SECTION -->
    <section id="text-inputs" class="space-y-6">
        <div class="flex items-center gap-2 border-b border-zinc-200/80 dark:border-zinc-800 pb-3">
            <div class="w-6 h-6 rounded-lg bg-amber-100 dark:bg-amber-950/60 flex items-center justify-center text-amber-600 dark:text-amber-400">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
            </div>
            <div>
                <div class="flex items-center gap-2">
                    <h2 class="text-sm font-bold text-zinc-900 dark:text-white">Text & Number Inputs</h2>
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">&lt;x-input&gt;</span>
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">&lt;x-modern-input&gt;</span>
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">&lt;x-input-floating&gt;</span>
                </div>
                <p class="text-[11px] text-zinc-500">Standard, icon-prefixed, and floating label text and currency inputs.</p>
            </div>
        </div>

        <x-card title="Interactive Text & Number Controls" subtitle="Try typing or testing the interactive masks and icons.">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- 1. Standard Input -->
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <span class="text-xs font-bold text-zinc-700 dark:text-zinc-300">Standard Input</span>
                        <span class="text-[10px] font-mono text-emerald-600 dark:text-emerald-400">&lt;x-input&gt;</span>
                    </div>
                    <x-input name="demo_fullname" label="Full Name" placeholder="e.g. Andy Ian" value="Andy Ian" />
                </div>

                <!-- 2. Currency Input -->
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <span class="text-xs font-bold text-zinc-700 dark:text-zinc-300">Currency Mask Input</span>
                        <span class="text-[10px] font-mono text-emerald-600 dark:text-emerald-400">:isCurrency="true"</span>
                    </div>
                    <x-input name="demo_price" label="Project Budget (IDR)" placeholder="100.000" :isCurrency="true" value="15000000" />
                </div>

                <!-- 3. Modern Input with Icon -->
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <span class="text-xs font-bold text-zinc-700 dark:text-zinc-300">Modern Input with Icon</span>
                        <span class="text-[10px] font-mono text-emerald-600 dark:text-emerald-400">&lt;x-modern-input&gt;</span>
                    </div>
                    <x-modern-input name="demo_email" label="Email Address" type="email" value="andy@intechstudio.id">
                        <x-slot:iconSlot>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </x-slot:iconSlot>
                    </x-modern-input>
                </div>

                <!-- 4. Floating Label Input -->
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs font-bold text-zinc-700 dark:text-zinc-300">Floating Label Input</span>
                        <span class="text-[10px] font-mono text-emerald-600 dark:text-emerald-400">&lt;x-input-floating&gt;</span>
                    </div>
                    <div class="pt-1">
                        <x-input-floating name="demo_floating_user" label="Username / Handle" value="andyian" />
                    </div>
                </div>

                <!-- 5. Floating Label Password -->
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs font-bold text-zinc-700 dark:text-zinc-300">Floating Password Input</span>
                        <span class="text-[10px] font-mono text-emerald-600 dark:text-emerald-400">type="password"</span>
                    </div>
                    <div class="pt-1">
                        <x-input-floating type="password" name="demo_floating_pwd" label="Account Password" value="SecretP@ssw0rd!" />
                    </div>
                </div>

                <!-- 6. Disabled Input -->
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <span class="text-xs font-bold text-zinc-700 dark:text-zinc-300">Readonly / Disabled Input</span>
                        <span class="text-[10px] font-mono text-zinc-400">disabled</span>
                    </div>
                    <x-input name="demo_disabled" label="System ID (Auto)" value="USR-98421" disabled />
                </div>
            </div>

            <!-- Code Snippet -->
            <div class="mt-6 p-3.5 rounded-xl bg-zinc-900 dark:bg-black text-zinc-300 font-mono text-xs overflow-x-auto">
                <div class="flex items-center justify-between text-[11px] text-zinc-400 mb-2 border-b border-zinc-800 pb-1.5">
                    <span>Blade Syntax Comparison</span>
                    <span class="text-emerald-400">copy-paste ready</span>
                </div>
                <pre class="text-zinc-300">&lt;!-- 1. Standard Input --&gt;
&lt;x-input name="name" label="Full Name" placeholder="John Doe" /&gt;

&lt;!-- 2. Input with Currency Thousand Separator Mask --&gt;
&lt;x-input name="price" label="Price" :isCurrency="true" /&gt;

&lt;!-- 3. Modern Input with Icon Prefix Slot --&gt;
&lt;x-modern-input name="email" label="Email" type="email"&gt;
    &lt;x-slot:iconSlot&gt;
        &lt;svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"&gt;...&lt;/svg&gt;
    &lt;/x-slot:iconSlot&gt;
&lt;/x-modern-input&gt;

&lt;!-- 4. Floating Label Input (Glassmorphic) --&gt;
&lt;x-input-floating name="username" label="Username" /&gt;</pre>
            </div>
        </x-card>
    </section>

    <!-- 4. SELECT & DROPDOWNS SECTION -->
    <section id="select-inputs" class="space-y-6">
        <div class="flex items-center gap-2 border-b border-zinc-200/80 dark:border-zinc-800 pb-3">
            <div class="w-6 h-6 rounded-lg bg-indigo-100 dark:bg-indigo-950/60 flex items-center justify-center text-indigo-600 dark:text-indigo-400">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </div>
            <div>
                <div class="flex items-center gap-2">
                    <h2 class="text-sm font-bold text-zinc-900 dark:text-white">Select & Dropdowns</h2>
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">&lt;x-select&gt;</span>
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">&lt;x-modern-select&gt;</span>
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">&lt;x-select-floating&gt;</span>
                </div>
                <p class="text-[11px] text-zinc-500">Dropdown select controls supporting key-value options arrays and custom icons.</p>
            </div>
        </div>

        <x-card title="Interactive Select Components" subtitle="Select options with standard, modern with icon, and floating labels.">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- 1. Standard Select -->
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <span class="text-xs font-bold text-zinc-700 dark:text-zinc-300">Standard Select</span>
                        <span class="text-[10px] font-mono text-emerald-600 dark:text-emerald-400">&lt;x-select&gt;</span>
                    </div>
                    <x-select name="demo_role" label="User Role" :options="['admin' => 'Administrator', 'editor' => 'Editor', 'member' => 'Member']" value="admin" />
                </div>

                <!-- 2. Modern Select with Icon -->
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <span class="text-xs font-bold text-zinc-700 dark:text-zinc-300">Modern Select with Icon</span>
                        <span class="text-[10px] font-mono text-emerald-600 dark:text-emerald-400">&lt;x-modern-select&gt;</span>
                    </div>
                    <x-modern-select name="demo_dept" label="Department" :options="['tech' => 'Engineering & Tech', 'design' => 'Product Design', 'marketing' => 'Marketing']" value="tech">
                        <x-slot:iconSlot>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </x-slot:iconSlot>
                    </x-modern-select>
                </div>

                <!-- 3. Floating Label Select -->
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs font-bold text-zinc-700 dark:text-zinc-300">Floating Label Select</span>
                        <span class="text-[10px] font-mono text-emerald-600 dark:text-emerald-400">&lt;x-select-floating&gt;</span>
                    </div>
                    <div class="pt-1">
                        <x-select-floating name="demo_country" label="Country of Origin" :options="['id' => 'Indonesia', 'us' => 'United States', 'sg' => 'Singapore', 'jp' => 'Japan']" value="id" />
                    </div>
                </div>
            </div>

            <!-- Code Snippet -->
            <div class="mt-6 p-3.5 rounded-xl bg-zinc-900 dark:bg-black text-zinc-300 font-mono text-xs overflow-x-auto">
                <div class="flex items-center justify-between text-[11px] text-zinc-400 mb-2 border-b border-zinc-800 pb-1.5">
                    <span>Select Syntax Example</span>
                    <span class="text-emerald-400">copy-paste ready</span>
                </div>
                <pre class="text-zinc-300">&lt;!-- Standard Select with options array --&gt;
&lt;x-select name="role" label="Role" :options="['admin' =&gt; 'Administrator', 'user' =&gt; 'User']" value="admin" /&gt;

&lt;!-- Floating Select Dropdown --&gt;
&lt;x-select-floating name="status" label="Status" :options="['active' =&gt; 'Active', 'inactive' =&gt; 'Inactive']" /&gt;</pre>
            </div>
        </x-card>
    </section>

    <!-- 5. TEXTAREAS SECTION -->
    <section id="textarea-inputs" class="space-y-6">
        <div class="flex items-center gap-2 border-b border-zinc-200/80 dark:border-zinc-800 pb-3">
            <div class="w-6 h-6 rounded-lg bg-teal-100 dark:bg-teal-950/60 flex items-center justify-center text-teal-600 dark:text-teal-400">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path></svg>
            </div>
            <div>
                <div class="flex items-center gap-2">
                    <h2 class="text-sm font-bold text-zinc-900 dark:text-white">Textareas & Multiline Inputs</h2>
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">&lt;x-textarea&gt;</span>
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">&lt;x-modern-textarea&gt;</span>
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">&lt;x-textarea-floating&gt;</span>
                </div>
                <p class="text-[11px] text-zinc-500">Multiline inputs for notes, descriptions, and addresses.</p>
            </div>
        </div>

        <x-card title="Interactive Multiline Controls" subtitle="All textareas support configurable row heights and focus rings.">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- 1. Standard Textarea -->
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <span class="text-xs font-bold text-zinc-700 dark:text-zinc-300">Standard Textarea</span>
                        <span class="text-[10px] font-mono text-emerald-600 dark:text-emerald-400">&lt;x-textarea&gt;</span>
                    </div>
                    <x-textarea name="demo_bio" label="Biography" rows="3" value="Experienced software developer building modern enterprise web applications." />
                </div>

                <!-- 2. Modern Textarea with Icon -->
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <span class="text-xs font-bold text-zinc-700 dark:text-zinc-300">Modern Textarea with Icon</span>
                        <span class="text-[10px] font-mono text-emerald-600 dark:text-emerald-400">&lt;x-modern-textarea&gt;</span>
                    </div>
                    <x-modern-textarea name="demo_notes" label="Meeting Minutes" rows="3" value="Reviewed database indexing and Tailwind 4 theme performance.">
                        <x-slot:iconSlot>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                        </x-slot:iconSlot>
                    </x-modern-textarea>
                </div>

                <!-- 3. Floating Label Textarea -->
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs font-bold text-zinc-700 dark:text-zinc-300">Floating Label Textarea</span>
                        <span class="text-[10px] font-mono text-emerald-600 dark:text-emerald-400">&lt;x-textarea-floating&gt;</span>
                    </div>
                    <div class="pt-1">
                        <x-textarea-floating name="demo_address" label="Company Physical Address" rows="3" value="Gedung Cyber 2 Lt. 18, Jl. H.R. Rasuna Said, Jakarta Selatan" />
                    </div>
                </div>
            </div>
        </x-card>
    </section>

    <!-- 6. TOGGLES, SWITCHES, CHECKBOXES & RADIOS -->
    <section id="toggles" class="space-y-6">
        <div class="flex items-center gap-2 border-b border-zinc-200/80 dark:border-zinc-800 pb-3">
            <div class="w-6 h-6 rounded-lg bg-emerald-100 dark:bg-emerald-950/60 flex items-center justify-center text-emerald-600 dark:text-emerald-400">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
            </div>
            <div>
                <div class="flex items-center gap-2">
                    <h2 class="text-sm font-bold text-zinc-900 dark:text-white">Toggles, Checkboxes & Radios</h2>
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">&lt;x-toggle&gt;</span>
                </div>
                <p class="text-[11px] text-zinc-500">Boolean switches with automatic fallback and native form selectors.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Toggles Card -->
            <x-card title="iOS-Style Toggle Switches" subtitle="Includes hidden fallback for boolean MySQL/PG fields.">
                <div class="space-y-4">
                    <x-toggle name="demo_toggle_active" label="Account Active" :checked="true" />
                    <x-toggle name="demo_toggle_2fa" label="Require 2FA Authentication" :checked="true" />
                    <x-toggle name="demo_toggle_email" label="Marketing Notifications" :checked="false" />
                </div>
            </x-card>

            <!-- Checkboxes Card -->
            <x-card title="Tailwind Form Checkboxes" subtitle="Multi-selection items with rounded corners.">
                <div class="space-y-3">
                    <label class="flex items-center gap-2.5 text-xs font-bold text-zinc-700 dark:text-zinc-300 cursor-pointer">
                        <input type="checkbox" checked class="w-4 h-4 rounded text-emerald-600 focus:ring-emerald-500 border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800 cursor-pointer">
                        <span>Email Digest Daily</span>
                    </label>
                    <label class="flex items-center gap-2.5 text-xs font-bold text-zinc-700 dark:text-zinc-300 cursor-pointer">
                        <input type="checkbox" checked class="w-4 h-4 rounded text-emerald-600 focus:ring-emerald-500 border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800 cursor-pointer">
                        <span>Security Alert SMS</span>
                    </label>
                    <label class="flex items-center gap-2.5 text-xs font-bold text-zinc-400 dark:text-zinc-600 cursor-not-allowed">
                        <input type="checkbox" disabled class="w-4 h-4 rounded text-zinc-400 border-zinc-300 dark:border-zinc-800 dark:bg-zinc-800/50 cursor-not-allowed">
                        <span>Beta Feature Access (Locked)</span>
                    </label>
                </div>
            </x-card>

            <!-- Radio Buttons Card -->
            <x-card title="Radio Options Group" subtitle="Single choice selection sets.">
                <div class="space-y-3">
                    <label class="flex items-center gap-2.5 text-xs font-bold text-zinc-700 dark:text-zinc-300 cursor-pointer">
                        <input type="radio" name="plan_choice" value="standard" checked class="w-4 h-4 text-emerald-600 focus:ring-emerald-500 border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800 cursor-pointer">
                        <span>Standard Community Plan</span>
                    </label>
                    <label class="flex items-center gap-2.5 text-xs font-bold text-zinc-700 dark:text-zinc-300 cursor-pointer">
                        <input type="radio" name="plan_choice" value="pro" class="w-4 h-4 text-emerald-600 focus:ring-emerald-500 border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800 cursor-pointer">
                        <span>Professional Enterprise Plan</span>
                    </label>
                </div>
            </x-card>
        </div>
    </section>

    <!-- 7. DATE & FILE UPLOADS SECTION -->
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

    <!-- 8. CARDS & CONTAINERS SECTION -->
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

    <!-- 9. ALERTS & NOTIFICATIONS SECTION -->
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

        <!-- Inline Banners -->
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
        </div>

        <!-- Interactive Toast Triggers -->
        <x-card title="Interactive Real-Time Toast Triggers" subtitle="Click any button below to trigger SweetAlert/Alpine toast events instantly.">
            <div class="flex flex-wrap items-center gap-3">
                <x-button variant="primary" icon="check"
                    @click="window.dispatchEvent(new CustomEvent('notify', { detail: { message: 'Item created successfully!', type: 'success' } }))">
                    Success Toast
                </x-button>

                <x-button variant="danger" icon="trash"
                    @click="window.dispatchEvent(new CustomEvent('notify', { detail: { message: 'Failed to delete record!', type: 'error' } }))">
                    Error Toast
                </x-button>

                <x-button variant="warning" icon="exclamation-circle"
                    @click="window.dispatchEvent(new CustomEvent('notify', { detail: { message: 'Warning: Session expiring in 5 minutes.', type: 'warning' } }))">
                    Warning Toast
                </x-button>

                <x-button variant="info" icon="information-circle"
                    @click="window.dispatchEvent(new CustomEvent('notify', { detail: { message: 'Background batch job completed.', type: 'info' } }))">
                    Info Toast
                </x-button>

                <!-- SweetAlert Confirmation Modal Demo -->
                <x-button variant="secondary" icon="fa fa-bell"
                    @click="window.dispatchEvent(new CustomEvent('open-delete-modal', { detail: { action: '#' } }))">
                    Test SweetAlert Confirm Modal
                </x-button>
            </div>
        </x-card>
    </section>
</div>
@endsection
