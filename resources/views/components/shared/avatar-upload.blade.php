@props(['name' => '', 'initials' => 'AD', 'size' => 'lg'])

@php
    $sizes = ['sm' => 'w-10 h-10 text-sm', 'md' => 'w-16 h-16 text-base', 'lg' => 'w-24 h-24 text-2xl', 'xl' => 'w-32 h-32 text-3xl'];
    $sizeClass = $sizes[$size] ?? $sizes['lg'];
@endphp

<div x-data="{ preview: null }" {{ $attributes }}>
    <div class="flex flex-col items-center">
        <div class="relative group">
            <template x-if="preview">
                <img :src="preview" alt="Avatar" class="{{ $sizeClass }} rounded-2xl object-cover border-2 border-border dark:border-white/10 shadow-soft" />
            </template>
            <template x-if="!preview">
                <div class="{{ $sizeClass }} rounded-2xl bg-primary flex items-center justify-center text-white font-bold border-2 border-border dark:border-white/10 shadow-soft">
                    {{ $initials }}
                </div>
            </template>
            <label class="absolute inset-0 flex items-center justify-center bg-secondary/50 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer">
                <input type="file" accept="image/*" class="sr-only" @change="e => { const f = e.target.files[0]; if(f) { const r = new FileReader(); r.onload = ev => preview = ev.target.result; r.readAsDataURL(f); } }" />
                <x-ui.icon name="photo" class="w-6 h-6 text-white" />
            </label>
        </div>
        @if ($slot->isNotEmpty())
            <div class="mt-3">{{ $slot }}</div>
        @endif
    </div>
</div>
