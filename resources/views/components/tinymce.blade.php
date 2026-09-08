@props([
    'name',
    'id' => null,
    'label' => null,
    'value' => null,
    'height' => 320,
    'placeholder' => 'Start typing your content...',
    'required' => false,
])

@php
    $id = $id ?? $name;
@endphp

@once
    @push('styles')
        @vite('resources/css/form-libs.css')
        @include('admin.partials.form-styles')
    @endpush
    @push('scripts')
        @vite('resources/js/form-libs.js')
    @endpush
@endonce

<div class="space-y-1.5">
    @if ($label)
        <label for="{{ $id }}"
            class="block text-xs uppercase tracking-wider font-bold text-zinc-500 dark:text-zinc-400">
            {{ $label }}
        </label>
    @endif

    <div wire:ignore class="rounded-xl overflow-hidden shadow-2xs border border-zinc-200/80 dark:border-zinc-700/80">
        <textarea name="{{ $name }}" id="{{ $id }}" {{ $required ? 'required' : '' }}
            {{ $attributes->merge(['class' => 'w-full hidden']) }}
            placeholder="{{ $placeholder }}">{{ old($name, $value) }}</textarea>
    </div>

    @error($name)
        <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
    @enderror
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    function initTinyMce_{{ str_replace(['-', '.', ' '], '_', $id) }}() {
        if (typeof tinymce === 'undefined') {
            setTimeout(initTinyMce_{{ str_replace(['-', '.', ' '], '_', $id) }}, 100);
            return;
        }

        var editorId = '{{ $id }}';
        if (tinymce.get(editorId)) {
            tinymce.remove('#' + editorId);
        }

        var isDark = document.documentElement.classList.contains('dark');

        tinymce.init({
            selector: '#' + editorId,
            height: {{ $height }},
            menubar: false,
            branding: false,
            promotion: false,
            plugins: [
                'anchor', 'autolink', 'charmap', 'code', 'codesample', 'directionality',
                'emoticons', 'fullscreen', 'help', 'image', 'insertdatetime', 'link',
                'lists', 'media', 'nonbreaking', 'pagebreak', 'preview', 'searchreplace',
                'table', 'visualblocks', 'visualchars', 'wordcount'
            ],
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist | link image media table | code preview fullscreen | removeformat',
            skin: isDark ? 'oxide-dark' : 'oxide',
            content_css: isDark ? 'dark' : 'default',
            content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; font-size: 14px; ' +
                (isDark ? 'background-color: #18181b; color: #f4f4f5;' : 'background-color: #ffffff; color: #18181b;') + ' }',
            placeholder: '{{ $placeholder }}',
            setup: function(editor) {
                editor.on('change', function() {
                    editor.save();
                });
            }
        });
    }

    initTinyMce_{{ str_replace(['-', '.', ' '], '_', $id) }}();

    window.addEventListener('theme-changed', function() {
        initTinyMce_{{ str_replace(['-', '.', ' '], '_', $id) }}();
    });
});
</script>
@endpush
