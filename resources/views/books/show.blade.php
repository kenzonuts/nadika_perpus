@extends('layouts.dashboard')

@include('books.partials.sample-data')

@php $book = $books[0]; @endphp

@section('breadcrumb')
    <x-dashboard.breadcrumb :items="[
        ['label' => 'Dashboard', 'href' => url('/dashboard')],
        ['label' => 'Books', 'href' => url('/books')],
        ['label' => $book['title'], 'active' => true],
    ]" />
@endsection

@section('content')
    <div class="max-w-[1400px] mx-auto space-y-6">
        {{-- Header actions --}}
        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 animate-fade-up">
            <div class="flex items-start gap-4">
                <x-books.book-cover :book="$book" size="lg" class="!w-20 !h-28 hidden sm:flex" />
                <div>
                    <div class="flex flex-wrap items-center gap-2 mb-2">
                        <x-books.book-status :status="$book['status']" />
                        <x-books.book-badge type="category" :label="$book['category']" />
                    </div>
                    <h1 class="text-2xl lg:text-3xl font-bold text-secondary dark:text-white tracking-tight">{{ $book['title'] }}</h1>
                    <p class="mt-1 text-sm text-secondary/60 dark:text-white/60">{{ $book['subtitle'] }}</p>
                    <p class="mt-2 text-sm text-secondary/50 dark:text-white/50">by <span class="font-medium text-secondary dark:text-white">{{ $book['author'] }}</span></p>
                </div>
            </div>
            <div class="flex flex-wrap gap-2 shrink-0">
                <x-ui.button variant="outline" size="sm" href="{{ url('/books') }}">
                    <x-ui.icon name="arrow-left" class="w-4 h-4" />
                    Back
                </x-ui.button>
                <x-ui.button variant="outline" size="sm" type="button">
                    <x-ui.icon name="document-duplicate" class="w-4 h-4" />
                    Duplicate
                </x-ui.button>
                <x-ui.button variant="primary" size="sm" :href="url('/books/' . $book['id'] . '/edit')">
                    <x-ui.icon name="pencil-square" class="w-4 h-4" />
                    Edit
                </x-ui.button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Left: Cover + Info --}}
            <div class="space-y-6">
                <div class="bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-2xl p-6 shadow-soft text-center">
                    <x-books.book-cover :book="$book" size="xl" class="mx-auto max-w-[200px] mb-4" />
                    <div class="flex items-center justify-center gap-1 mb-2">
                        <x-ui.icon name="star" class="w-4 h-4 text-warning" />
                        <span class="text-sm font-semibold text-secondary dark:text-white">{{ $book['rating'] }}</span>
                        <span class="text-xs text-secondary/40 dark:text-white/40">({{ $book['borrows'] }} borrows)</span>
                    </div>
                    <x-books.book-badge
                        :type="$book['available'] > 0 ? 'available' : 'unavailable'"
                        :label="$book['available'] > 0 ? $book['available'] . ' copies available' : 'Out of stock'"
                        class="!text-sm"
                    />
                </div>

                <div class="bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-2xl p-6 shadow-soft">
                    <h3 class="text-sm font-semibold text-secondary dark:text-white mb-4">Book Details</h3>
                    <dl class="space-y-3 text-sm">
                        @foreach ([
                            ['ISBN', $book['isbn']],
                            ['Publisher', $book['publisher']],
                            ['Category', $book['category']],
                            ['Shelf', $book['shelf']],
                            ['Language', $book['language']],
                            ['Year', $book['year']],
                            ['Pages', $book['pages']],
                            ['Stock', $book['stock'] . ' total / ' . $book['available'] . ' available'],
                        ] as [$label, $value])
                            <div class="flex justify-between gap-4">
                                <dt class="text-secondary/50 dark:text-white/50 shrink-0">{{ $label }}</dt>
                                <dd class="font-medium text-secondary dark:text-white text-right {{ $label === 'ISBN' ? 'font-mono text-xs' : '' }}">{{ $value }}</dd>
                            </div>
                        @endforeach
                    </dl>
                </div>
            </div>

            {{-- Right: Description + History --}}
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-2xl p-6 shadow-soft">
                    <h3 class="text-sm font-semibold text-secondary dark:text-white mb-3">Description</h3>
                    <p class="text-sm text-secondary/70 dark:text-white/70 leading-relaxed">{{ $book['description'] }}</p>
                </div>

                <x-dashboard.timeline title="Borrow History">
                    @foreach ($borrowHistory as $item)
                        <x-dashboard.timeline-item
                            :icon="$item['action'] === 'Borrowed' ? 'arrow-right-circle' : 'arrow-left-circle'"
                            :title="$item['member']"
                            :description="$item['action'] . ' this book'"
                            :time="$item['date']"
                            :color="$item['color']"
                        />
                    @endforeach
                </x-dashboard.timeline>

                <x-dashboard.timeline title="Activity Timeline">
                    <x-dashboard.timeline-item icon="plus-circle" title="Book created" description="Added to catalog by Admin User" time="Jan 15, 2026" color="primary" />
                    <x-dashboard.timeline-item icon="pencil-square" title="Book updated" description="Stock quantity updated to {{ $book['stock'] }}" time="{{ $book['updated_at'] }}" color="warning" />
                    <x-dashboard.timeline-item icon="arrow-right-circle" title="Book borrowed" description="Last borrowed by John Mitchell" time="Jul 1, 2026" color="success" />
                </x-dashboard.timeline>
            </div>
        </div>
    </div>
@endsection
