@extends('layouts.dashboard')


@section('breadcrumb')
    <x-dashboard.breadcrumb :items="[
        ['label' => 'Dashboard', 'href' => url('/dashboard')],
        ['label' => 'Categories', 'href' => url('/categories')],
        ['label' => 'Create', 'active' => true],
    ]" />
@endsection

@section('content')
    <div
        class="max-w-[800px] mx-auto"
        x-data="{
            form: { name: '', slug: '', description: '', status: 'active' },
            dirty: false,
            init() {
                this.$watch('form', () => { this.dirty = true; }, { deep: true });
            },
            markClean() { this.dirty = false; },
            generateSlug() {
                this.form.slug = this.form.name.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '');
            }
        }"
    >
        <x-shared.page-toolbar
            title="Add Category"
            subtitle="Create a new category to organize your book collection."
            back-url="{{ url('/categories') }}"
            back-label="Back to Categories"
        />

        <form @submit.prevent="markClean()" class="space-y-6">
            <x-shared.form-section title="Category Information" description="Basic details for the new category.">
                <div class="space-y-5">
                    <x-ui.input
                        label="Name"
                        name="name"
                        placeholder="e.g. Programming"
                        x-model="form.name"
                        @input="generateSlug()"
                        required
                    />
                    <x-ui.input
                        label="Slug"
                        name="slug"
                        placeholder="e.g. programming"
                        hint="URL-friendly identifier. Auto-generated from name."
                        x-model="form.slug"
                    />
                    <div>
                        <x-ui.label for="description">Description</x-ui.label>
                        <textarea
                            id="description"
                            name="description"
                            rows="4"
                            x-model="form.description"
                            placeholder="Brief description of this category..."
                            class="block w-full px-4 py-3 text-sm text-secondary dark:text-white bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-xl transition-all duration-200 placeholder:text-secondary/40 dark:placeholder:text-white/40 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"
                        ></textarea>
                    </div>
                    <div>
                        <x-ui.label for="status" required>Status</x-ui.label>
                        <select
                            id="status"
                            name="status"
                            x-model="form.status"
                            class="block w-full px-4 py-3 text-sm text-secondary dark:text-white bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"
                        >
                            @foreach ($statuses as $status)
                                <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </x-shared.form-section>

            <div class="flex items-center justify-end gap-3">
                <x-ui.button variant="outline" href="{{ url('/categories') }}">Cancel</x-ui.button>
                <x-ui.button type="submit" variant="primary">
                    <x-ui.icon name="plus" class="w-4 h-4" />
                    Create Category
                </x-ui.button>
            </div>
        </form>
    </div>
@endsection
