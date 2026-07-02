<?php

namespace Database\Factories;

use App\Enums\Gender;
use App\Enums\MemberStatus;
use App\Models\Member;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Member>
 */
class MemberFactory extends Factory
{
    protected $model = Member::class;

    private static int $memberSequence = 0;

    public function definition(): array
    {
        self::$memberSequence++;

        return [
            'user_id' => null,
            'member_number' => 'MEM-'.str_pad((string) self::$memberSequence, 5, '0', STR_PAD_LEFT),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'birth_date' => fake()->dateTimeBetween('-60 years', '-18 years'),
            'gender' => fake()->randomElement(Gender::cases()),
            'photo' => null,
            'status' => MemberStatus::Active,
            'joined_at' => fake()->dateTimeBetween('-2 years', 'now'),
        ];
    }

    public function withUser(?User $user = null): static
    {
        return $this->state(fn (array $attributes) => [
            'user_id' => ($user ?? User::factory()->create())->id,
        ]);
    }
}
