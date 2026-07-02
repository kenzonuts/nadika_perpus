@extends('layouts.dashboard')

@include('books.partials.sample-data')

@section('breadcrumb')
    <x-dashboard.breadcrumb :items="[
        ['label' => 'Dashboard', 'href' => url('/dashboard')],
        ['label' => 'Books', 'href' => url('/books')],
        ['label' => 'Trash', 'active' => true],
    ]" />
@endsection

@section('content')
    <div class="max-w-[1200px] mx-auto space-y-6" x-data="{ searchQuery: '' }">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 animate-fade-up">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-secondary dark:text-white tracking-tight">Trash</h1>
                <p class="mt-1 text-sm text-secondary/60 dark:text-white/60">Deleted books can be restored or permanently removed.</p>
            </div>
            <x-ui.button variant="outline" size="sm" href="{{ url('/books') }}">
                <x-ui.icon name="arrow-left" class="w-4 h-4" />
                Back to Books
            </x-ui.button>
        </div>

        <div class="bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-2xl p-4 shadow-soft">
            <x-books.search-bar placeholder="Search deleted books..." />
        </div>

        @if (count($trashedBooks) > 0)
            <div class="bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-2xl shadow-soft overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-border dark:border-white/10 bg-background/50 dark:bg-white/5">
                                <th class="px-6 py-3.5 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase">Book</th>
                                <th class="px-6 py-3.5 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase hidden sm:table-cell">Author</th>
                                <th class="px-6 py-3.5 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase hidden md:table-cell">Category</th>
                                <th class="px-6 py-3.5 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase">Deleted</th>
                                <th class="px-6 py-3.5 text-right text-xs font-medium text-secondary/50 dark:text-white/50 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border dark:divide-white/10">
                            @foreach ($trashedBooks as $book)
                                <tr class="hover:bg-background/80 dark:hover:bg-white/5 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <x-books.book-cover :book="$book" size="sm" />
                                            <span class="font-medium text-secondary dark:text-white">{{ $book['title'] }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-secondary/60 dark:text-white/60 hidden sm:table-cell">{{ $book['author'] }}</td>
                                    <td class="px-6 py-4 hidden md:table-cell">
                                        <x-books.book-badge type="category" :label="$book['category']" />
                                    </td>
                                    <td class="px-6 py-4 text-xs text-secondary/40 dark:text-white/40">{{ $book['deleted_at'] }}</td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <x-ui.button variant="outline" size="sm" type="button">
                                                <x-ui.icon name="arrow-uturn-left" class="w-3.5 h-3.5" />
                                                Restore
                                            </x-ui.button>
                                            <x-ui.button variant="ghost" size="sm" type="button" class="!text-danger hover:!bg-danger/5">
                                                <x-ui.icon name="trash" class="w-3.5 h-3.5" />
                                                Delete
                                            </x-ui.button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <x-dashboard.empty-state
                title="Trash is empty"
                description="Deleted books will appear here. You can restore them or delete permanently."
                icon="trash"
                action="Back to Books"
                :action-href="url('/books')"
            />
        @endif
    </div>
@endsection
