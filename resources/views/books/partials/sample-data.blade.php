@php
    $books = [
        ['id' => 1, 'title' => 'Clean Code', 'subtitle' => 'A Handbook of Agile Software Craftsmanship', 'isbn' => '978-0132350884', 'author' => 'Robert C. Martin', 'publisher' => 'Prentice Hall', 'category' => 'Programming', 'shelf' => 'A-12', 'language' => 'English', 'year' => 2008, 'pages' => 464, 'stock' => 5, 'available' => 3, 'status' => 'published', 'rating' => 4.8, 'borrows' => 342, 'color' => 'from-blue-500 to-blue-600', 'updated_at' => '2 hours ago', 'description' => 'Even bad code can function. But if code is not clean, it can bring a development organization to its knees.'],
        ['id' => 2, 'title' => 'Design Patterns', 'subtitle' => 'Elements of Reusable Object-Oriented Software', 'isbn' => '978-0201633610', 'author' => 'Gang of Four', 'publisher' => 'Addison-Wesley', 'category' => 'Engineering', 'shelf' => 'A-08', 'language' => 'English', 'year' => 1994, 'pages' => 416, 'stock' => 4, 'available' => 1, 'status' => 'published', 'rating' => 4.9, 'borrows' => 289, 'color' => 'from-violet-500 to-violet-600', 'updated_at' => '5 hours ago', 'description' => 'Capturing a wealth of experience about the design of object-oriented software.'],
        ['id' => 3, 'title' => 'Atomic Habits', 'subtitle' => 'An Easy & Proven Way to Build Good Habits', 'isbn' => '978-0735211292', 'author' => 'James Clear', 'publisher' => 'Avery', 'category' => 'Self-Help', 'shelf' => 'C-03', 'language' => 'English', 'year' => 2018, 'pages' => 320, 'stock' => 8, 'available' => 0, 'status' => 'published', 'rating' => 4.9, 'borrows' => 256, 'color' => 'from-amber-500 to-amber-600', 'updated_at' => '1 day ago', 'description' => 'No matter your goals, Atomic Habits offers a proven framework for improving every day.'],
        ['id' => 4, 'title' => 'Deep Work', 'subtitle' => 'Rules for Focused Success in a Distracted World', 'isbn' => '978-1455586691', 'author' => 'Cal Newport', 'publisher' => 'Grand Central', 'category' => 'Productivity', 'shelf' => 'C-07', 'language' => 'English', 'year' => 2016, 'pages' => 304, 'stock' => 6, 'available' => 4, 'status' => 'published', 'rating' => 4.6, 'borrows' => 198, 'color' => 'from-rose-500 to-rose-600', 'updated_at' => '2 days ago', 'description' => 'Deep work is the ability to focus without distraction on a cognitively demanding task.'],
        ['id' => 5, 'title' => 'The Pragmatic Programmer', 'subtitle' => 'Your Journey to Mastery', 'isbn' => '978-0135957059', 'author' => 'David Thomas', 'publisher' => 'Addison-Wesley', 'category' => 'Programming', 'shelf' => 'A-15', 'language' => 'English', 'year' => 2019, 'pages' => 352, 'stock' => 3, 'available' => 2, 'status' => 'draft', 'rating' => 4.7, 'borrows' => 175, 'color' => 'from-emerald-500 to-emerald-600', 'updated_at' => '3 days ago', 'description' => 'The Pragmatic Programmer is one of those rare tech books you will read and re-read.'],
        ['id' => 6, 'title' => 'System Design Interview', 'subtitle' => 'An Insider\'s Guide', 'isbn' => '978-1736049117', 'author' => 'Alex Xu', 'publisher' => 'ByteByteGo', 'category' => 'Technology', 'shelf' => 'B-02', 'language' => 'English', 'year' => 2020, 'pages' => 320, 'stock' => 7, 'available' => 5, 'status' => 'published', 'rating' => 4.8, 'borrows' => 312, 'color' => 'from-cyan-500 to-cyan-600', 'updated_at' => '4 hours ago', 'description' => 'The system design interview is considered to be the most complex interview.'],
        ['id' => 7, 'title' => 'Introduction to Algorithms', 'subtitle' => 'Fourth Edition', 'isbn' => '978-0262046305', 'author' => 'Cormen et al.', 'publisher' => 'MIT Press', 'category' => 'Computer Science', 'shelf' => 'A-01', 'language' => 'English', 'year' => 2022, 'pages' => 1312, 'stock' => 2, 'available' => 2, 'status' => 'archived', 'rating' => 4.5, 'borrows' => 89, 'color' => 'from-indigo-500 to-indigo-600', 'updated_at' => '1 week ago', 'description' => 'A comprehensive update of the leading algorithms text.'],
        ['id' => 8, 'title' => 'Refactoring', 'subtitle' => 'Improving the Design of Existing Code', 'isbn' => '978-0134757599', 'author' => 'Martin Fowler', 'publisher' => 'Addison-Wesley', 'category' => 'Programming', 'shelf' => 'A-10', 'language' => 'English', 'year' => 2018, 'pages' => 448, 'stock' => 4, 'available' => 3, 'status' => 'published', 'rating' => 4.7, 'borrows' => 167, 'color' => 'from-teal-500 to-teal-600', 'updated_at' => '6 hours ago', 'description' => 'Refactoring is about improving the design of existing code.'],
    ];

    $trashedBooks = [
        ['id' => 101, 'title' => 'Legacy PHP Patterns', 'author' => 'Unknown', 'category' => 'Programming', 'deleted_at' => '3 days ago', 'color' => 'from-gray-500 to-gray-600'],
        ['id' => 102, 'title' => 'Outdated Network Guide', 'author' => 'Tech Press', 'category' => 'Technology', 'deleted_at' => '1 week ago', 'color' => 'from-slate-500 to-slate-600'],
    ];

    $categories = ['Programming', 'Engineering', 'Self-Help', 'Productivity', 'Technology', 'Computer Science'];
    $publishers = ['Prentice Hall', 'Addison-Wesley', 'Avery', 'Grand Central', 'MIT Press', 'ByteByteGo'];
    $authors = ['Robert C. Martin', 'Gang of Four', 'James Clear', 'Cal Newport', 'David Thomas', 'Alex Xu'];
    $languages = ['English', 'Indonesian', 'Spanish', 'French', 'German'];
    $shelves = ['A-01', 'A-08', 'A-10', 'A-12', 'A-15', 'B-02', 'C-03', 'C-07'];
    $statuses = ['published', 'draft', 'archived'];

    $borrowHistory = [
        ['member' => 'John Mitchell', 'action' => 'Borrowed', 'date' => 'Jul 1, 2026', 'color' => 'primary'],
        ['member' => 'Sarah Chen', 'action' => 'Returned', 'date' => 'Jun 28, 2026', 'color' => 'success'],
        ['member' => 'Michael Brown', 'action' => 'Borrowed', 'date' => 'Jun 25, 2026', 'color' => 'primary'],
        ['member' => 'Emily Davis', 'action' => 'Returned', 'date' => 'Jun 20, 2026', 'color' => 'success'],
    ];
@endphp
