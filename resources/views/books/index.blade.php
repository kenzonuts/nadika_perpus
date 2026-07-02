@extends('layouts.dashboard')

@include('books.partials.sample-data')

@section('breadcrumb')
    <x-dashboard.breadcrumb :items="[
        ['label' => 'Dashboard', 'href' => url('/dashboard')],
        ['label' => 'Books', 'active' => true],
    ]" />
@endsection

@section('content')
    <div class="max-w-[1600px] mx-auto space-y-6" x-data="booksIndex">
        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 animate-fade-up">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-secondary dark:text-white tracking-tight">Books</h1>
                <p class="mt-1 text-sm text-secondary/60 dark:text-white/60">Manage your digital library collection.</p>
            </div>
            <div class="flex flex-wrap items-center gap-2">
                <x-ui.button variant="outline" size="sm" href="{{ url('/books/import') }}">
                    <x-ui.icon name="arrow-up-tray" class="w-4 h-4" />
                    Import
                </x-ui.button>
                <x-ui.button variant="outline" size="sm" type="button">
                    <x-ui.icon name="arrow-down-tray" class="w-4 h-4" />
                    Export
                </x-ui.button>
                <x-ui.button variant="outline" size="sm" type="button" @click="refresh()" x-bind:disabled="loading">
                    <x-ui.icon name="arrow-path-rounded" class="w-4 h-4" ::class="loading ? 'animate-spin' : ''" />
                    Refresh
                </x-ui.button>
                <x-ui.button variant="primary" size="sm" href="{{ url('/books/create') }}">
                    <x-ui.icon name="plus" class="w-4 h-4" />
                    Add Book
                </x-ui.button>
            </div>
        </div>

        {{-- Statistics --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            <x-dashboard.stat-card title="Total Books" value="12,847" icon="book-open" color="primary" />
            <x-dashboard.stat-card title="Available Books" value="10,234" icon="check-circle" color="success" />
            <x-dashboard.stat-card title="Borrowed Books" value="892" icon="arrow-right-circle" color="warning" />
            <x-dashboard.stat-card title="Archived Books" value="156" icon="archive-box" color="danger" />
        </div>

        {{-- Filters --}}
        <x-books.filter-bar :categories="$categories" :publishers="$publishers" :authors="$authors" />

        {{-- Content --}}
        <div x-show="loading" x-cloak>
            <div x-show="viewMode === 'table'">
                <x-dashboard.skeleton-table :rows="6" />
            </div>
            <div x-show="viewMode === 'grid'" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                @for ($i = 0; $i < 4; $i++)
                    <x-dashboard.skeleton-card />
                @endfor
            </div>
        </div>

        <div x-show="!loading">
            <div x-show="viewMode === 'table'" x-transition>
                <x-books.book-table :books="$books" />
            </div>
            <div x-show="viewMode === 'grid'" x-transition class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                @foreach ($books as $book)
                    <x-books.book-card :book="$book" />
                @endforeach
            </div>
        </div>

        <x-books.pagination :current="1" :total="5" :total-items="48" />

        <x-books.book-modal />
    </div>
@endsection
