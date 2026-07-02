@php
    $borrowings = [
        ['id' => 1, 'member' => 'John Mitchell', 'member_id' => 101, 'book' => 'Clean Code', 'book_id' => 1, 'isbn' => '978-0132350884', 'borrow_date' => 'Jul 1, 2026', 'due_date' => 'Jul 15, 2026', 'status' => 'active', 'returned_date' => null, 'notes' => 'Standard 14-day loan period.'],
        ['id' => 2, 'member' => 'Sarah Chen', 'member_id' => 102, 'book' => 'Design Patterns', 'book_id' => 2, 'isbn' => '978-0201633610', 'borrow_date' => 'Jun 28, 2026', 'due_date' => 'Jul 12, 2026', 'status' => 'returned', 'returned_date' => 'Jul 10, 2026', 'notes' => 'Returned in good condition.'],
        ['id' => 3, 'member' => 'Michael Brown', 'member_id' => 103, 'book' => 'Atomic Habits', 'book_id' => 3, 'isbn' => '978-0735211292', 'borrow_date' => 'Jun 20, 2026', 'due_date' => 'Jul 4, 2026', 'status' => 'overdue', 'returned_date' => null, 'notes' => 'Reminder sent on Jul 3.'],
        ['id' => 4, 'member' => 'Emily Davis', 'member_id' => 104, 'book' => 'Deep Work', 'book_id' => 4, 'isbn' => '978-1455586691', 'borrow_date' => 'Jul 2, 2026', 'due_date' => 'Jul 16, 2026', 'status' => 'active', 'returned_date' => null, 'notes' => ''],
        ['id' => 5, 'member' => 'David Wilson', 'member_id' => 105, 'book' => 'The Pragmatic Programmer', 'book_id' => 5, 'isbn' => '978-0135957059', 'borrow_date' => 'Jun 15, 2026', 'due_date' => 'Jun 29, 2026', 'status' => 'returned', 'returned_date' => 'Jun 27, 2026', 'notes' => 'Early return.'],
        ['id' => 6, 'member' => 'Lisa Anderson', 'member_id' => 106, 'book' => 'System Design Interview', 'book_id' => 6, 'isbn' => '978-1736049117', 'borrow_date' => 'Jun 25, 2026', 'due_date' => 'Jul 9, 2026', 'status' => 'returned', 'returned_date' => 'Jul 8, 2026', 'notes' => ''],
        ['id' => 7, 'member' => 'James Taylor', 'member_id' => 107, 'book' => 'Refactoring', 'book_id' => 8, 'isbn' => '978-0134757599', 'borrow_date' => 'Jul 3, 2026', 'due_date' => 'Jul 17, 2026', 'status' => 'active', 'returned_date' => null, 'notes' => ''],
        ['id' => 8, 'member' => 'Anna Martinez', 'member_id' => 108, 'book' => 'Introduction to Algorithms', 'book_id' => 7, 'isbn' => '978-0262046305', 'borrow_date' => 'May 30, 2026', 'due_date' => 'Jun 13, 2026', 'status' => 'overdue', 'returned_date' => null, 'notes' => 'Multiple reminders sent.'],
    ];

    $borrowingHistory = [
        ['id' => 1, 'member' => 'John Mitchell', 'book' => 'Clean Code', 'borrow_date' => 'Jul 1, 2026', 'due_date' => 'Jul 15, 2026', 'status' => 'active', 'returned_date' => null],
        ['id' => 2, 'member' => 'Sarah Chen', 'book' => 'Design Patterns', 'borrow_date' => 'Jun 28, 2026', 'due_date' => 'Jul 12, 2026', 'status' => 'returned', 'returned_date' => 'Jul 10, 2026'],
        ['id' => 3, 'member' => 'Michael Brown', 'book' => 'Atomic Habits', 'borrow_date' => 'Jun 20, 2026', 'due_date' => 'Jul 4, 2026', 'status' => 'overdue', 'returned_date' => null],
        ['id' => 4, 'member' => 'Emily Davis', 'book' => 'Deep Work', 'borrow_date' => 'Jul 2, 2026', 'due_date' => 'Jul 16, 2026', 'status' => 'active', 'returned_date' => null],
        ['id' => 5, 'member' => 'David Wilson', 'book' => 'The Pragmatic Programmer', 'borrow_date' => 'Jun 15, 2026', 'due_date' => 'Jun 29, 2026', 'status' => 'returned', 'returned_date' => 'Jun 27, 2026'],
        ['id' => 6, 'member' => 'Lisa Anderson', 'book' => 'System Design Interview', 'borrow_date' => 'Jun 25, 2026', 'due_date' => 'Jul 9, 2026', 'status' => 'returned', 'returned_date' => 'Jul 8, 2026'],
        ['id' => 7, 'member' => 'James Taylor', 'book' => 'Refactoring', 'borrow_date' => 'Jul 3, 2026', 'due_date' => 'Jul 17, 2026', 'status' => 'active', 'returned_date' => null],
        ['id' => 8, 'member' => 'Anna Martinez', 'book' => 'Introduction to Algorithms', 'borrow_date' => 'May 30, 2026', 'due_date' => 'Jun 13, 2026', 'status' => 'overdue', 'returned_date' => null],
        ['id' => 9, 'member' => 'Robert Lee', 'book' => 'Clean Code', 'borrow_date' => 'May 10, 2026', 'due_date' => 'May 24, 2026', 'status' => 'returned', 'returned_date' => 'May 22, 2026'],
        ['id' => 10, 'member' => 'Jennifer White', 'book' => 'Design Patterns', 'borrow_date' => 'May 5, 2026', 'due_date' => 'May 19, 2026', 'status' => 'returned', 'returned_date' => 'May 18, 2026'],
        ['id' => 11, 'member' => 'Chris Johnson', 'book' => 'Atomic Habits', 'borrow_date' => 'Apr 28, 2026', 'due_date' => 'May 12, 2026', 'status' => 'returned', 'returned_date' => 'May 14, 2026'],
        ['id' => 12, 'member' => 'Maria Garcia', 'book' => 'Deep Work', 'borrow_date' => 'Apr 15, 2026', 'due_date' => 'Apr 29, 2026', 'status' => 'returned', 'returned_date' => 'Apr 27, 2026'],
    ];

    $borrowingTimeline = [
        ['icon' => 'arrow-right-circle', 'title' => 'Borrowing created', 'description' => 'Book checked out to member', 'time' => 'Jul 1, 2026 · 10:30 AM', 'color' => 'primary'],
        ['icon' => 'bell', 'title' => 'Due date reminder', 'description' => 'Automated reminder sent to member', 'time' => 'Jul 12, 2026 · 9:00 AM', 'color' => 'warning'],
        ['icon' => 'document-text', 'title' => 'Note added', 'description' => 'Standard 14-day loan period recorded', 'time' => 'Jul 1, 2026 · 10:32 AM', 'color' => 'neutral'],
    ];

    $members = [
        ['id' => 101, 'name' => 'John Mitchell', 'email' => 'john.mitchell@email.com', 'membership' => 'Premium'],
        ['id' => 102, 'name' => 'Sarah Chen', 'email' => 'sarah.chen@email.com', 'membership' => 'Standard'],
        ['id' => 103, 'name' => 'Michael Brown', 'email' => 'michael.brown@email.com', 'membership' => 'Standard'],
        ['id' => 104, 'name' => 'Emily Davis', 'email' => 'emily.davis@email.com', 'membership' => 'Premium'],
        ['id' => 105, 'name' => 'David Wilson', 'email' => 'david.wilson@email.com', 'membership' => 'Standard'],
    ];

    $availableBooks = [
        ['id' => 1, 'title' => 'Clean Code', 'author' => 'Robert C. Martin', 'isbn' => '978-0132350884', 'available' => 3],
        ['id' => 2, 'title' => 'Design Patterns', 'author' => 'Gang of Four', 'isbn' => '978-0201633610', 'available' => 1],
        ['id' => 4, 'title' => 'Deep Work', 'author' => 'Cal Newport', 'isbn' => '978-1455586691', 'available' => 4],
        ['id' => 6, 'title' => 'System Design Interview', 'author' => 'Alex Xu', 'isbn' => '978-1736049117', 'available' => 5],
        ['id' => 8, 'title' => 'Refactoring', 'author' => 'Martin Fowler', 'isbn' => '978-0134757599', 'available' => 3],
    ];

    $borrowingStatuses = ['active', 'returned', 'overdue'];

    $statusBadgeMap = [
        'active' => ['label' => 'Active', 'variant' => 'success'],
        'returned' => ['label' => 'Returned', 'variant' => 'neutral'],
        'overdue' => ['label' => 'Overdue', 'variant' => 'danger'],
    ];
@endphp
