@extends('layouts.dashboard')

@include('books.partials.sample-data')

@php $book = $books[0]; @endphp

@section('breadcrumb')
    <x-dashboard.breadcrumb :items="[
        ['label' => 'Dashboard', 'href' => url('/dashboard')],
        ['label' => 'Books', 'href' => url('/books')],
        ['label' => 'Edit', 'active' => true],
    ]" />
@endsection

@section('content')
    <div class="max-w-[1400px] mx-auto" x-data="bookForm({{ json_encode($book) }})">
        <div
            x-show="dirty"
            x-cloak
            x-transition
            class="mb-4 flex items-center gap-3 px-4 py-3 bg-warning/10 border border-warning/20 rounded-xl text-sm text-warning"
            role="alert"
        >
            <x-ui.icon name="exclamation-triangle" class="w-5 h-5 shrink-0" />
            You have unsaved changes. Don't forget to save before leaving this page.
        </div>

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6 animate-fade-up">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-secondary dark:text-white tracking-tight">Edit Book</h1>
                <p class="mt-1 text-sm text-secondary/60 dark:text-white/60">Update information for <span class="font-medium text-secondary dark:text-white">{{ $book['title'] }}</span></p>
            </div>
            <div class="flex gap-2">
                <x-ui.button variant="outline" size="sm" :href="url('/books/' . $book['id'])">
                    <x-ui.icon name="eye" class="w-4 h-4" />
                    View
                </x-ui.button>
                <x-ui.button variant="outline" size="sm" href="{{ url('/books') }}">
                    <x-ui.icon name="arrow-left" class="w-4 h-4" />
                    Back
                </x-ui.button>
            </div>
        </div>

        <form @submit.prevent="markClean()" class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
            <div class="lg:col-span-2">
                <div class="bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-2xl p-6 shadow-soft">
                    <h2 class="text-base font-semibold text-secondary dark:text-white mb-6">Book Information</h2>
                    <x-books.book-form :categories="$categories" :shelves="$shelves" :languages="$languages" mode="edit" />
                </div>

                <div class="flex items-center justify-between mt-6">
                    <x-ui.button variant="ghost" type="button" class="!text-danger hover:!bg-danger/5" href="{{ url('/books/trash') }}">
                        <x-ui.icon name="trash" class="w-4 h-4" />
                        Delete Book
                    </x-ui.button>
                    <div class="flex gap-3">
                        <x-ui.button variant="outline" :href="url('/books/' . $book['id'])">Cancel</x-ui.button>
                        <x-ui.button type="submit" variant="primary">Save Changes</x-ui.button>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1">
                <x-books.book-preview />
            </div>
        </form>
    </div>
@endsection
