@php
    $returns = [
        ['id' => 1, 'borrowing_id' => 2, 'member' => 'Sarah Chen', 'member_id' => 102, 'book' => 'Design Patterns', 'book_id' => 2, 'isbn' => '978-0201633610', 'borrow_date' => 'Jun 28, 2026', 'due_date' => 'Jul 12, 2026', 'return_date' => 'Jul 10, 2026', 'is_late' => false, 'days_late' => 0, 'condition' => 'good', 'fine_amount' => 0, 'fine_paid' => true, 'processed_by' => 'Admin User', 'notes' => 'Returned in excellent condition.'],
        ['id' => 2, 'borrowing_id' => 5, 'member' => 'David Wilson', 'member_id' => 105, 'book' => 'The Pragmatic Programmer', 'book_id' => 5, 'isbn' => '978-0135957059', 'borrow_date' => 'Jun 15, 2026', 'due_date' => 'Jun 29, 2026', 'return_date' => 'Jun 27, 2026', 'is_late' => false, 'days_late' => 0, 'condition' => 'good', 'fine_amount' => 0, 'fine_paid' => true, 'processed_by' => 'Admin User', 'notes' => 'Early return.'],
        ['id' => 3, 'borrowing_id' => 6, 'member' => 'Lisa Anderson', 'member_id' => 106, 'book' => 'System Design Interview', 'book_id' => 6, 'isbn' => '978-1736049117', 'borrow_date' => 'Jun 25, 2026', 'due_date' => 'Jul 9, 2026', 'return_date' => 'Jul 8, 2026', 'is_late' => false, 'days_late' => 0, 'condition' => 'fair', 'fine_amount' => 0, 'fine_paid' => true, 'processed_by' => 'Librarian Staff', 'notes' => 'Minor wear on cover.'],
        ['id' => 4, 'borrowing_id' => 11, 'member' => 'Chris Johnson', 'member_id' => 109, 'book' => 'Atomic Habits', 'book_id' => 3, 'isbn' => '978-0735211292', 'borrow_date' => 'Apr 28, 2026', 'due_date' => 'May 12, 2026', 'return_date' => 'May 14, 2026', 'is_late' => true, 'days_late' => 2, 'condition' => 'good', 'fine_amount' => 4.00, 'fine_paid' => true, 'processed_by' => 'Admin User', 'notes' => 'Late return fine collected.'],
        ['id' => 5, 'borrowing_id' => 9, 'member' => 'Robert Lee', 'member_id' => 110, 'book' => 'Clean Code', 'book_id' => 1, 'isbn' => '978-0132350884', 'borrow_date' => 'May 10, 2026', 'due_date' => 'May 24, 2026', 'return_date' => 'May 22, 2026', 'is_late' => false, 'days_late' => 0, 'condition' => 'good', 'fine_amount' => 0, 'fine_paid' => true, 'processed_by' => 'Admin User', 'notes' => ''],
        ['id' => 6, 'borrowing_id' => 10, 'member' => 'Jennifer White', 'member_id' => 111, 'book' => 'Design Patterns', 'book_id' => 2, 'isbn' => '978-0201633610', 'borrow_date' => 'May 5, 2026', 'due_date' => 'May 19, 2026', 'return_date' => 'May 18, 2026', 'is_late' => false, 'days_late' => 0, 'condition' => 'good', 'fine_amount' => 0, 'fine_paid' => true, 'processed_by' => 'Librarian Staff', 'notes' => ''],
        ['id' => 7, 'borrowing_id' => 12, 'member' => 'Maria Garcia', 'member_id' => 112, 'book' => 'Deep Work', 'book_id' => 4, 'isbn' => '978-1455586691', 'borrow_date' => 'Apr 15, 2026', 'due_date' => 'Apr 29, 2026', 'return_date' => 'Apr 27, 2026', 'is_late' => false, 'days_late' => 0, 'condition' => 'excellent', 'fine_amount' => 0, 'fine_paid' => true, 'processed_by' => 'Admin User', 'notes' => 'Like new condition.'],
        ['id' => 8, 'borrowing_id' => 15, 'member' => 'Thomas Wright', 'member_id' => 113, 'book' => 'Refactoring', 'book_id' => 8, 'isbn' => '978-0134757599', 'borrow_date' => 'Mar 20, 2026', 'due_date' => 'Apr 3, 2026', 'return_date' => 'Apr 8, 2026', 'is_late' => true, 'days_late' => 5, 'condition' => 'damaged', 'fine_amount' => 15.00, 'fine_paid' => false, 'processed_by' => 'Admin User', 'notes' => 'Pages 120-125 torn. Damage fee applied.'],
    ];

    $returnTimeline = [
        ['icon' => 'arrow-left-circle', 'title' => 'Return processed', 'description' => 'Book checked back into inventory', 'time' => 'Jul 10, 2026 · 2:15 PM', 'color' => 'success'],
        ['icon' => 'clipboard-document-list', 'title' => 'Condition assessed', 'description' => 'Book condition recorded as Good', 'time' => 'Jul 10, 2026 · 2:16 PM', 'color' => 'primary'],
        ['icon' => 'check-circle', 'title' => 'Return completed', 'description' => 'No fines applicable', 'time' => 'Jul 10, 2026 · 2:17 PM', 'color' => 'success'],
    ];

    $conditionBadgeMap = [
        'excellent' => ['label' => 'Excellent', 'variant' => 'success'],
        'good' => ['label' => 'Good', 'variant' => 'success'],
        'fair' => ['label' => 'Fair', 'variant' => 'warning'],
        'damaged' => ['label' => 'Damaged', 'variant' => 'danger'],
        'lost' => ['label' => 'Lost', 'variant' => 'danger'],
    ];
@endphp
