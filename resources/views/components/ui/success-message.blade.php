<p {{ $attributes->merge(['class' => 'flex items-center gap-1.5 text-sm text-success', 'role' => 'status']) }}>
    <x-ui.icon name="check-circle" class="w-4 h-4 shrink-0" />
    <span>{{ $slot }}</span>
</p>
