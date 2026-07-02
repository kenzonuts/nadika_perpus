<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $password = 'Password123!';

        $superAdmin = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin@library.local',
            'phone' => '+6281234567890',
            'password' => $password,
            'email_verified_at' => now(),
        ]);
        $superAdmin->assignRole('super-admin');

        $librarian = User::factory()->create([
            'name' => 'Head Librarian',
            'email' => 'librarian@library.local',
            'phone' => '+6281234567891',
            'password' => $password,
            'email_verified_at' => now(),
        ]);
        $librarian->assignRole('librarian');

        $memberUser = User::factory()->create([
            'name' => 'Library Member',
            'email' => 'member@library.local',
            'phone' => '+6281234567892',
            'password' => $password,
            'email_verified_at' => now(),
        ]);
        $memberUser->assignRole('member');

        Member::factory()->create([
            'user_id' => $memberUser->id,
            'member_number' => 'MEM-00001',
            'phone' => $memberUser->phone,
            'joined_at' => now(),
        ]);
    }
}
