@props(['id', 'userId' => null])

<!-- User Form Modal -->
<div id="{{ $id }}" class="hidden fixed inset-0 z-50 overflow-y-auto" aria-labelledby="{{ $id }}-title" role="dialog" aria-modal="true">
    <!-- Background overlay -->
    <div class="fixed inset-0 bg-zinc-900/50 dark:bg-zinc-950/80 transition-opacity backdrop-blur-xs" onclick="closeModal('{{ $id }}')"></div>

    <div class="flex min-h-full items-center justify-center p-4">
        <div class="relative w-full max-w-md transform overflow-hidden rounded-2xl bg-white dark:bg-zinc-900 text-left shadow-xl border border-zinc-200/80 dark:border-zinc-800 transition-all">
            <!-- Header -->
            <div class="bg-white dark:bg-zinc-900 px-6 py-4 border-b border-zinc-100 dark:border-zinc-800">
                <h3 class="text-base font-bold text-zinc-900 dark:text-white" id="{{ $id }}-title">
                    {{ $userId ? 'Edit User' : 'Add New User' }}
                </h3>
            </div>

            <!-- Form -->
            <form id="userForm" method="POST" action="{{ $userId ? route('admin.users.update', $userId) : route('admin.users.store') }}">
                @if($userId)
                    @method('PUT')
                @endif
                @csrf

                <div class="bg-white dark:bg-zinc-900 px-6 py-4 space-y-4">
                    <!-- Name -->
                    <x-input type="text" name="name" id="name" label="Name" :required="true" placeholder="Full Name" />

                    <!-- Email -->
                    <x-input type="email" name="email" id="email" label="Email" :required="true" placeholder="name@example.com" />

                    <!-- Password -->
                    <x-password name="password" id="password" label="{{ $userId ? 'Password (leave blank to keep current)' : 'Password' }}" :required="!$userId" />

                    <!-- Role -->
                    <x-select name="role" id="role" label="Role" :required="true">
                        <option value="">Select Role</option>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </x-select>
                </div>

                <!-- Footer -->
                <div class="bg-zinc-50 dark:bg-zinc-800/50 px-6 py-4 flex flex-row-reverse gap-3 border-t border-zinc-100 dark:border-zinc-800">
                    <x-button type="submit" variant="primary" :solid="true">
                        {{ $userId ? 'Update' : 'Create' }}
                    </x-button>
                    <x-button type="button" variant="secondary" onclick="closeModal('{{ $id }}')">
                        Cancel
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function openUserModal(modalId, userData = null) {
        if (userData) {
            document.getElementById('name').value = userData.name || '';
            document.getElementById('email').value = userData.email || '';
            document.getElementById('role').value = userData.role || '';
        } else {
            document.getElementById('userForm').reset();
        }
        document.getElementById(modalId).classList.remove('hidden');
    }

    function closeUserModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
        document.getElementById('userForm').reset();
    }
</script>
@endpush
