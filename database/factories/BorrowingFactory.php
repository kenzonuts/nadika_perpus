<?php

namespace Database\Factories;

use App\Enums\BorrowingStatus;
use App\Models\Borrowing;
use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Borrowing>
 */
class BorrowingFactory extends Factory
{
    protected $model = Borrowing::class;

    private static int $borrowSequence = 0;

    public function definition(): array
    {
        self::$borrowSequence++;

        $borrowDate = fake()->dateTimeBetween('-3 months', 'now');

        return [
            'member_id' => Member::factory(),
            'borrow_number' => 'BRW-'.str_pad((string) self::$borrowSequence, 5, '0', STR_PAD_LEFT),
            'borrow_date' => $borrowDate,
            'due_date' => (clone $borrowDate)->modify('+14 days'),
            'status' => fake()->randomElement(BorrowingStatus::cases()),
            'notes' => fake()->optional()->sentence(),
        ];
    }
}
