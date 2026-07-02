@extends('layouts.dashboard')

@include('categories.partials.sample-data')

@section('breadcrumb')
    <x-dashboard.breadcrumb :items="[
        ['label' => 'Dashboard', 'href' => url('/dashboard')],
        ['label' => 'Categories', 'href' => url('/categories')],
        ['label' => 'Trash', 'active' => true],
    ]" />
@endsection

@section('content')
    <div class="max-w-[1200px] mx-auto space-y-6" x-data="{ searchQuery: '' }">
        <x-shared.page-toolbar
            title="Trash"
            subtitle="Deleted categories can be restored or permanently removed."
            back-url="{{ url('/categories') }}"
            back-label="Back to Categories"
        />

        <x-shared.filter-toolbar placeholder="Search deleted categories..." :filters="false" />

        @if (count($trashedCategories) > 0)
            <div class="bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-2xl shadow-soft overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-border dark:border-white/10 bg-background/50 dark:bg-white/5">
                                <th class="px-6 py-3.5 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase">Name</th>
                                <th class="px-6 py-3.5 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase hidden sm:table-cell">Slug</th>
                                <th class="px-6 py-3.5 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase hidden md:table-cell">Books</th>
                                <th class="px-6 py-3.5 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase">Deleted</th>
                                <th class="px-6 py-3.5 text-right text-xs font-medium text-secondary/50 dark:text-white/50 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border dark:divide-white/10">
                            @foreach ($trashedCategories as $category)
                                <tr class="hover:bg-background/80 dark:hover:bg-white/5 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 rounded-xl bg-gradient-to-br {{ $category['color'] }} flex items-center justify-center shrink-0 opacity-60">
                                                <x-ui.icon name="rectangle-stack" class="w-4 h-4 text-white" />
                                            </div>
                                            <div>
                                                <span class="font-medium text-secondary dark:text-white">{{ $category['name'] }}</span>
                                                <p class="text-xs text-secondary/40 dark:text-white/40 mt-0.5 sm:hidden">{{ $category['slug'] }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-secondary/60 dark:text-white/60 font-mono text-xs hidden sm:table-cell">{{ $category['slug'] }}</td>
                                    <td class="px-6 py-4 font-medium text-secondary dark:text-white hidden md:table-cell">{{ number_format($category['books_count']) }}</td>
                                    <td class="px-6 py-4 text-xs text-secondary/40 dark:text-white/40">{{ $category['deleted_at'] }}</td>
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
            <div class="bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-2xl shadow-soft">
                <x-dashboard.empty-state
                    title="Trash is empty"
                    description="Deleted categories will appear here. You can restore them or delete permanently."
                    icon="trash"
                    action="Back to Categories"
                    :action-href="url('/categories')"
                />
            </div>
        @endif
    </div>
@endsection
