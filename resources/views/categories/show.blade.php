@extends('layouts.dashboard')


@php
    $category = $categories[0];
    $statusConfig = [
        'active' => ['label' => 'Active', 'variant' => 'success'],
        'inactive' => ['label' => 'Inactive', 'variant' => 'neutral'],
        'draft' => ['label' => 'Draft', 'variant' => 'warning'],
    ];
    $statusItem = $statusConfig[$category['status']] ?? $statusConfig['active'];
@endphp

@section('breadcrumb')
    <x-dashboard.breadcrumb :items="[
        ['label' => 'Dashboard', 'href' => url('/dashboard')],
        ['label' => 'Categories', 'href' => url('/categories')],
        ['label' => $category['name'], 'active' => true],
    ]" />
@endsection

@section('content')
    <div class="max-w-[1400px] mx-auto space-y-6">
        <x-shared.page-toolbar :title="$category['name']" :subtitle="$category['description']">
            <x-ui.button variant="outline" size="sm" href="{{ url('/categories') }}">
                <x-ui.icon name="arrow-left" class="w-4 h-4" />
                Back
            </x-ui.button>
            <x-ui.button variant="primary" size="sm" :href="url('/categories/' . $category['id'] . '/edit')">
                <x-ui.icon name="pencil-square" class="w-4 h-4" />
                Edit
            </x-ui.button>
        </x-shared.page-toolbar>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Category Info --}}
            <div class="space-y-6">
                <div class="bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-2xl p-6 shadow-soft text-center">
                    <div class="w-20 h-20 mx-auto rounded-2xl bg-gradient-to-br {{ $category['color'] }} flex items-center justify-center mb-4">
                        <x-ui.icon name="rectangle-stack" class="w-10 h-10 text-white" />
                    </div>
                    <x-ui.badge :variant="$statusItem['variant']" class="mb-3">{{ $statusItem['label'] }}</x-ui.badge>
                    <p class="text-2xl font-bold text-secondary dark:text-white">{{ number_format($category['books_count']) }}</p>
                    <p class="text-sm text-secondary/50 dark:text-white/50 mt-1">Books in this category</p>
                </div>

                <div class="bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-2xl p-6 shadow-soft">
                    <h3 class="text-sm font-semibold text-secondary dark:text-white mb-4">Category Details</h3>
                    <dl class="space-y-3 text-sm">
                        @foreach ([
                            ['Slug', $category['slug']],
                            ['Status', $statusItem['label']],
                            ['Books', number_format($category['books_count'])],
                            ['Last Updated', $category['updated_at']],
                        ] as [$label, $value])
                            <div class="flex justify-between gap-4">
                                <dt class="text-secondary/50 dark:text-white/50 shrink-0">{{ $label }}</dt>
                                <dd class="font-medium text-secondary dark:text-white text-right {{ $label === 'Slug' ? 'font-mono text-xs' : '' }}">{{ $value }}</dd>
                            </div>
                        @endforeach
                    </dl>
                </div>
            </div>

            {{-- Books List --}}
            <div class="lg:col-span-2">
                <x-shared.form-section title="Books in Category" description="Books assigned to this category.">
                    @if (count($categoryBooks) > 0)
                        <div class="overflow-x-auto -mx-6 -mb-6">
                            <table class="w-full text-sm">
                                <thead>
                                    <tr class="border-b border-border dark:border-white/10 bg-background/50 dark:bg-white/5">
                                        <th class="px-6 py-3 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase">Title</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase hidden sm:table-cell">Author</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase hidden md:table-cell">Updated</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-border dark:divide-white/10">
                                    @foreach ($categoryBooks as $book)
                                        @php
                                            $bookStatus = [
                                                'published' => ['label' => 'Published', 'variant' => 'success'],
                                                'draft' => ['label' => 'Draft', 'variant' => 'warning'],
                                                'archived' => ['label' => 'Archived', 'variant' => 'neutral'],
                                            ];
                                            $bookStatusItem = $bookStatus[$book['status']] ?? $bookStatus['published'];
                                        @endphp
                                        <tr class="hover:bg-background/80 dark:hover:bg-white/5 transition-colors">
                                            <td class="px-6 py-3.5">
                                                <a href="{{ url('/books/' . $book['id']) }}" class="font-medium text-secondary dark:text-white hover:text-primary transition-colors">
                                                    {{ $book['title'] }}
                                                </a>
                                            </td>
                                            <td class="px-6 py-3.5 text-secondary/60 dark:text-white/60 hidden sm:table-cell">{{ $book['author'] }}</td>
                                            <td class="px-6 py-3.5">
                                                <x-ui.badge :variant="$bookStatusItem['variant']">{{ $bookStatusItem['label'] }}</x-ui.badge>
                                            </td>
                                            <td class="px-6 py-3.5 text-xs text-secondary/40 dark:text-white/40 hidden md:table-cell">{{ $book['updated_at'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <x-dashboard.empty-state
                            title="No books in this category"
                            description="Books assigned to this category will appear here."
                            icon="book-open"
                        />
                    @endif
                </x-shared.form-section>
            </div>
        </div>
    </div>
@endsection
