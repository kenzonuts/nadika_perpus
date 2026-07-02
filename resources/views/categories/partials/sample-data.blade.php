@php
    $categories = [
        ['id' => 1, 'name' => 'Programming', 'slug' => 'programming', 'description' => 'Software development, coding practices, and programming languages.', 'books_count' => 342, 'status' => 'active', 'color' => 'from-blue-500 to-blue-600', 'updated_at' => '2 hours ago'],
        ['id' => 2, 'name' => 'Engineering', 'slug' => 'engineering', 'description' => 'Software architecture, design patterns, and system engineering.', 'books_count' => 189, 'status' => 'active', 'color' => 'from-violet-500 to-violet-600', 'updated_at' => '5 hours ago'],
        ['id' => 3, 'name' => 'Self-Help', 'slug' => 'self-help', 'description' => 'Personal development, habits, and productivity improvement.', 'books_count' => 256, 'status' => 'active', 'color' => 'from-amber-500 to-amber-600', 'updated_at' => '1 day ago'],
        ['id' => 4, 'name' => 'Productivity', 'slug' => 'productivity', 'description' => 'Time management, focus, and workflow optimization.', 'books_count' => 198, 'status' => 'active', 'color' => 'from-rose-500 to-rose-600', 'updated_at' => '2 days ago'],
        ['id' => 5, 'name' => 'Technology', 'slug' => 'technology', 'description' => 'Emerging tech, IT infrastructure, and digital transformation.', 'books_count' => 175, 'status' => 'draft', 'color' => 'from-emerald-500 to-emerald-600', 'updated_at' => '3 days ago'],
        ['id' => 6, 'name' => 'Computer Science', 'slug' => 'computer-science', 'description' => 'Algorithms, data structures, and theoretical foundations.', 'books_count' => 312, 'status' => 'active', 'color' => 'from-cyan-500 to-cyan-600', 'updated_at' => '4 hours ago'],
        ['id' => 7, 'name' => 'Business', 'slug' => 'business', 'description' => 'Management, entrepreneurship, and organizational strategy.', 'books_count' => 89, 'status' => 'inactive', 'color' => 'from-indigo-500 to-indigo-600', 'updated_at' => '1 week ago'],
        ['id' => 8, 'name' => 'Science Fiction', 'slug' => 'science-fiction', 'description' => 'Speculative fiction exploring future technologies and societies.', 'books_count' => 167, 'status' => 'active', 'color' => 'from-teal-500 to-teal-600', 'updated_at' => '6 hours ago'],
    ];

    $trashedCategories = [
        ['id' => 101, 'name' => 'Legacy Tech', 'slug' => 'legacy-tech', 'description' => 'Outdated technology references and deprecated practices.', 'books_count' => 12, 'status' => 'inactive', 'color' => 'from-gray-500 to-gray-600', 'deleted_at' => '3 days ago'],
        ['id' => 102, 'name' => 'Uncategorized', 'slug' => 'uncategorized', 'description' => 'Default category for unassigned books.', 'books_count' => 0, 'status' => 'inactive', 'color' => 'from-slate-500 to-slate-600', 'deleted_at' => '1 week ago'],
    ];

    $statuses = ['active', 'inactive', 'draft'];

    $categoryBooks = [
        ['id' => 1, 'title' => 'Clean Code', 'author' => 'Robert C. Martin', 'status' => 'published', 'updated_at' => '2 hours ago'],
        ['id' => 2, 'title' => 'Design Patterns', 'author' => 'Gang of Four', 'status' => 'published', 'updated_at' => '5 hours ago'],
        ['id' => 5, 'title' => 'The Pragmatic Programmer', 'author' => 'David Thomas', 'status' => 'draft', 'updated_at' => '3 days ago'],
        ['id' => 8, 'title' => 'Refactoring', 'author' => 'Martin Fowler', 'status' => 'published', 'updated_at' => '6 hours ago'],
    ];
@endphp
