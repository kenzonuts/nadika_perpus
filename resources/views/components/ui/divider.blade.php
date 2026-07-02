@props(['text' => 'OR'])

<div {{ $attributes->merge(['class' => 'relative flex items-center py-2']) }} role="separator" aria-label="{{ $text }}">
    <div class="flex-grow border-t border-border dark:border-white/10"></div>
    <span class="flex-shrink mx-4 text-xs font-medium text-secondary/40 dark:text-white/40 uppercase tracking-wider">{{ $text }}</span>
    <div class="flex-grow border-t border-border dark:border-white/10"></div>
</div>
