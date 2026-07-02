@extends('layouts.dashboard')


@php $book = $books[0]; @endphp

@section('breadcrumb')
    <x-dashboard.breadcrumb :items="[
        ['label' => 'Dashboard', 'href' => url('/dashboard')],
        ['label' => 'Books', 'href' => url('/books')],
        ['label' => 'Create', 'active' => true],
    ]" />
@endsection

@section('content')
    <div class="max-w-[1400px] mx-auto" x-data="bookForm()">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6 animate-fade-up">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-secondary dark:text-white tracking-tight">Add New Book</h1>
                <p class="mt-1 text-sm text-secondary/60 dark:text-white/60">Fill in the details to add a book to your catalog.</p>
            </div>
            <x-ui.button variant="outline" size="sm" href="{{ url('/books') }}">
                <x-ui.icon name="arrow-left" class="w-4 h-4" />
                Back to Books
            </x-ui.button>
        </div>

        <form @submit.prevent="markClean()" class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
            <div class="lg:col-span-2">
                <div class="bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-2xl p-6 shadow-soft">
                    <h2 class="text-base font-semibold text-secondary dark:text-white mb-6">Book Information</h2>
                    <x-books.book-form :categories="$categories" :shelves="$shelves" :languages="$languages" mode="create" />
                </div>

                <div class="flex items-center justify-end gap-3 mt-6">
                    <x-ui.button variant="outline" href="{{ url('/books') }}">Cancel</x-ui.button>
                    <x-ui.button type="submit" variant="primary">
                        <x-ui.icon name="plus" class="w-4 h-4" />
                        Create Book
                    </x-ui.button>
                </div>
            </div>

            <div class="lg:col-span-1">
                <x-books.book-preview />
            </div>
        </form>
    </div>
@endsection
