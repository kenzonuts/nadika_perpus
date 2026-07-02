<p {{ $attributes->merge(['class' => 'flex items-center gap-1.5 text-sm text-danger', 'role' => 'alert']) }}>
    <x-ui.icon name="exclamation-circle" class="w-4 h-4 shrink-0" />
    <span>{{ $slot }}</span>
</p>
