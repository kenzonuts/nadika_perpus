@extends('layouts.dashboard')

@include('categories.partials.sample-data')

@php $category = $categories[0]; @endphp

@section('breadcrumb')
    <x-dashboard.breadcrumb :items="[
        ['label' => 'Dashboard', 'href' => url('/dashboard')],
        ['label' => 'Categories', 'href' => url('/categories')],
        ['label' => 'Edit', 'active' => true],
    ]" />
@endsection

@section('content')
    <div
        class="max-w-[800px] mx-auto"
        x-data="{
            form: {{ json_encode(['name' => $category['name'], 'slug' => $category['slug'], 'description' => $category['description'], 'status' => $category['status']]) }},
            dirty: false,
            init() {
                this.$watch('form', () => { this.dirty = true; }, { deep: true });
                window.addEventListener('beforeunload', (e) => {
                    if (this.dirty) { e.preventDefault(); e.returnValue = ''; }
                });
            },
            markClean() { this.dirty = false; }
        }"
    >
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

        <x-shared.page-toolbar
            title="Edit Category"
            :subtitle="'Update information for ' . $category['name']"
            back-url="{{ url('/categories') }}"
            back-label="Back to Categories"
        >
            <x-ui.button variant="outline" size="sm" :href="url('/categories/' . $category['id'])">
                <x-ui.icon name="eye" class="w-4 h-4" />
                View
            </x-ui.button>
        </x-shared.page-toolbar>

        <form @submit.prevent="markClean()" class="space-y-6">
            <x-shared.form-section title="Category Information" description="Update the category details below.">
                <div class="space-y-5">
                    <x-ui.input
                        label="Name"
                        name="name"
                        x-model="form.name"
                        required
                    />
                    <x-ui.input
                        label="Slug"
                        name="slug"
                        hint="URL-friendly identifier."
                        x-model="form.slug"
                    />
                    <div>
                        <x-ui.label for="description">Description</x-ui.label>
                        <textarea
                            id="description"
                            name="description"
                            rows="4"
                            x-model="form.description"
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

            <div class="flex items-center justify-between">
                <x-ui.button variant="ghost" type="button" class="!text-danger hover:!bg-danger/5" href="{{ url('/categories/trash') }}">
                    <x-ui.icon name="trash" class="w-4 h-4" />
                    Delete Category
                </x-ui.button>
                <div class="flex gap-3">
                    <x-ui.button variant="outline" :href="url('/categories/' . $category['id'])">Cancel</x-ui.button>
                    <x-ui.button type="submit" variant="primary">Save Changes</x-ui.button>
                </div>
            </div>
        </form>
    </div>
@endsection
