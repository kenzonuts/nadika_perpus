@extends('layouts.dashboard')


@section('breadcrumb')
    <x-dashboard.breadcrumb :items="[
        ['label' => 'Dashboard', 'href' => url('/dashboard')],
        ['label' => 'Categories', 'active' => true],
    ]" />
@endsection

@section('content')
    <div class="max-w-[1600px] mx-auto space-y-6" x-data="moduleIndex">
        <x-shared.page-toolbar
            title="Categories"
            subtitle="Organize your library collection into categories."
        >
            <x-ui.button variant="outline" size="sm" href="{{ url('/categories/trash') }}">
                <x-ui.icon name="trash" class="w-4 h-4" />
                Trash
            </x-ui.button>
            <x-ui.button variant="outline" size="sm" type="button" @click="refresh()" x-bind:disabled="loading">
                <x-ui.icon name="arrow-path-rounded" class="w-4 h-4" ::class="loading ? 'animate-spin' : ''" />
                Refresh
            </x-ui.button>
            <x-ui.button variant="primary" size="sm" type="button" @click="createModalOpen = true">
                <x-ui.icon name="plus" class="w-4 h-4" />
                Add Category
            </x-ui.button>
        </x-shared.page-toolbar>

        {{-- Statistics --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach ($statCards as $stat)
                <x-dashboard.stat-card :title="$stat['title']" :value="$stat['value']" :icon="$stat['icon']" :color="$stat['color']" />
            @endforeach
        </div>

        {{-- Filters --}}
        <x-shared.filter-toolbar placeholder="Search categories...">
            <select class="px-3 py-2.5 text-sm bg-background dark:bg-white/5 border border-border dark:border-white/10 rounded-xl text-secondary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/20">
                <option value="">All Status</option>
                @foreach ($statuses as $status)
                    <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                @endforeach
            </select>
            <select class="px-3 py-2.5 text-sm bg-background dark:bg-white/5 border border-border dark:border-white/10 rounded-xl text-secondary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/20">
                <option value="">Sort by</option>
                <option value="name">Name</option>
                <option value="books">Books Count</option>
                <option value="updated">Last Updated</option>
            </select>
        </x-shared.filter-toolbar>

        {{-- Loading skeleton --}}
        <div x-show="loading" x-cloak>
            <x-dashboard.skeleton-table :rows="6" />
        </div>

        {{-- Table --}}
        <div x-show="!loading">
            @if (count($categories) > 0)
                <div class="bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-2xl shadow-soft overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="border-b border-border dark:border-white/10 bg-background/50 dark:bg-white/5">
                                    <th class="px-4 lg:px-6 py-3.5 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider">Name</th>
                                    <th class="px-4 lg:px-6 py-3.5 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider hidden md:table-cell">Slug</th>
                                    <th class="px-4 lg:px-6 py-3.5 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider hidden sm:table-cell">Books</th>
                                    <th class="px-4 lg:px-6 py-3.5 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider">Status</th>
                                    <th class="px-4 lg:px-6 py-3.5 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider hidden lg:table-cell">Updated</th>
                                    <th class="px-4 lg:px-6 py-3.5 text-right text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-border dark:divide-white/10">
                                @foreach ($categories as $category)
                                    @php
                                        $statusConfig = [
                                            'active' => ['label' => 'Active', 'variant' => 'success'],
                                            'inactive' => ['label' => 'Inactive', 'variant' => 'neutral'],
                                            'draft' => ['label' => 'Draft', 'variant' => 'warning'],
                                        ];
                                        $statusItem = $statusConfig[$category['status']] ?? $statusConfig['active'];
                                    @endphp
                                    <tr class="hover:bg-background/80 dark:hover:bg-white/5 transition-colors group">
                                        <td class="px-4 lg:px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                <div class="w-9 h-9 rounded-xl bg-gradient-to-br {{ $category['color'] }} flex items-center justify-center shrink-0">
                                                    <x-ui.icon name="rectangle-stack" class="w-4 h-4 text-white" />
                                                </div>
                                                <div class="min-w-0">
                                                    <a href="{{ url('/categories/' . $category['id']) }}" class="font-medium text-secondary dark:text-white hover:text-primary transition-colors line-clamp-1">
                                                        {{ $category['name'] }}
                                                    </a>
                                                    <p class="text-xs text-secondary/40 dark:text-white/40 mt-0.5 line-clamp-1 md:hidden">{{ $category['slug'] }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 lg:px-6 py-4 text-secondary/60 dark:text-white/60 font-mono text-xs hidden md:table-cell">{{ $category['slug'] }}</td>
                                        <td class="px-4 lg:px-6 py-4 font-medium text-secondary dark:text-white hidden sm:table-cell">{{ number_format($category['books_count']) }}</td>
                                        <td class="px-4 lg:px-6 py-4">
                                            <x-ui.badge :variant="$statusItem['variant']">{{ $statusItem['label'] }}</x-ui.badge>
                                        </td>
                                        <td class="px-4 lg:px-6 py-4 text-xs text-secondary/40 dark:text-white/40 hidden lg:table-cell">{{ $category['updated_at'] }}</td>
                                        <td class="px-4 lg:px-6 py-4 text-right">
                                            <div class="flex items-center justify-end gap-1">
                                                <x-ui.button variant="ghost" size="sm" :href="url('/categories/' . $category['id'])" class="!p-2">
                                                    <x-ui.icon name="eye" class="w-4 h-4" />
                                                </x-ui.button>
                                                <x-ui.button variant="ghost" size="sm" :href="url('/categories/' . $category['id'] . '/edit')" class="!p-2">
                                                    <x-ui.icon name="pencil-square" class="w-4 h-4" />
                                                </x-ui.button>
                                                <x-ui.button
                                                    variant="ghost"
                                                    size="sm"
                                                    type="button"
                                                    class="!p-2 !text-danger hover:!bg-danger/5"
                                                    @click="selectedItem = @json($category); deleteModalOpen = true"
                                                >
                                                    <x-ui.icon name="trash" class="w-4 h-4" />
                                                </x-ui.button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <x-books.pagination :current="1" :total="3" :total-items="24" />
            @else
                <div class="bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-2xl shadow-soft">
                    <x-dashboard.empty-state
                        title="No categories yet"
                        description="Create your first category to organize books in your library."
                        icon="rectangle-stack"
                        action="Add Category"
                        action-href="#"
                    />
                </div>
            @endif
        </div>

        {{-- Create Modal --}}
        <div
            x-show="createModalOpen"
            x-cloak
            class="fixed inset-0 z-[100] flex items-center justify-center p-4"
            role="dialog"
            aria-modal="true"
            aria-labelledby="create-category-title"
        >
            <div class="fixed inset-0 bg-secondary/50 dark:bg-black/60 backdrop-blur-sm" @click="createModalOpen = false"></div>
            <div
                x-show="createModalOpen"
                x-transition
                class="relative w-full max-w-lg bg-card dark:bg-secondary border border-border dark:border-white/10 rounded-2xl shadow-soft-xl p-6"
            >
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 id="create-category-title" class="text-lg font-semibold text-secondary dark:text-white">Add Category</h3>
                        <p class="text-sm text-secondary/50 dark:text-white/50 mt-0.5">Create a new category for your library.</p>
                    </div>
                    <button type="button" @click="createModalOpen = false" class="p-2 rounded-lg text-secondary/50 dark:text-white/50 hover:bg-background dark:hover:bg-white/5 transition-colors" aria-label="Close">
                        <x-ui.icon name="x-mark" class="w-5 h-5" />
                    </button>
                </div>

                <form @submit.prevent="createModalOpen = false" class="space-y-4">
                    <x-ui.input label="Name" name="name" placeholder="e.g. Programming" required />
                    <div>
                        <x-ui.label for="description">Description</x-ui.label>
                        <textarea
                            id="description"
                            name="description"
                            rows="3"
                            placeholder="Brief description of this category..."
                            class="block w-full px-4 py-3 text-sm text-secondary dark:text-white bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-xl transition-all duration-200 placeholder:text-secondary/40 dark:placeholder:text-white/40 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"
                        ></textarea>
                    </div>
                    <div>
                        <x-ui.label for="status">Status</x-ui.label>
                        <select
                            id="status"
                            name="status"
                            class="block w-full px-4 py-3 text-sm text-secondary dark:text-white bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"
                        >
                            @foreach ($statuses as $status)
                                <option value="{{ $status }}" @selected($status === 'active')>{{ ucfirst($status) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex gap-3 pt-2">
                        <x-ui.button variant="outline" class="flex-1" type="button" @click="createModalOpen = false">Cancel</x-ui.button>
                        <x-ui.button variant="primary" class="flex-1" type="submit">
                            <x-ui.icon name="plus" class="w-4 h-4" />
                            Create Category
                        </x-ui.button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Delete Modal --}}
        <x-shared.confirm-modal
            title="Delete Category"
            message="Are you sure you want to delete this category? It will be moved to trash and can be restored later."
            confirm-label="Delete"
            cancel-label="Cancel"
            :danger="true"
        >
            <template x-if="selectedItem">
                <div class="flex items-center gap-4 p-4 bg-background dark:bg-white/5 rounded-xl">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br shrink-0 flex items-center justify-center" :class="selectedItem.color || 'from-primary to-primary-dark'">
                        <x-ui.icon name="rectangle-stack" class="w-4 h-4 text-white" />
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-medium text-secondary dark:text-white truncate" x-text="selectedItem.name"></p>
                        <p class="text-xs text-secondary/50 dark:text-white/50" x-text="selectedItem.books_count + ' books'"></p>
                    </div>
                </div>
            </template>
        </x-shared.confirm-modal>
    </div>
@endsection
