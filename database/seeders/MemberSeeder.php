<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    public function run(): void
    {
        $existingCount = Member::query()->count();
        $toCreate = max(0, 20 - $existingCount);

        $start = $existingCount + 1;

        for ($i = 0; $i < $toCreate; $i++) {
            Member::factory()->create([
                'member_number' => 'MEM-'.str_pad((string) ($start + $i), 5, '0', STR_PAD_LEFT),
            ]);
        }
    }
}
