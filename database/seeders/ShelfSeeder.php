<?php

namespace Database\Seeders;

use App\Models\Shelf;
use Illuminate\Database\Seeder;

class ShelfSeeder extends Seeder
{
    public function run(): void
    {
        $locations = ['Floor 1', 'Floor 2', 'Basement', 'Reading Room', 'Archive'];

        for ($i = 1; $i <= 20; $i++) {
            $code = 'SH-A-'.str_pad((string) $i, 3, '0', STR_PAD_LEFT);

            Shelf::query()->firstOrCreate(
                ['code' => $code],
                [
                    'name' => "Shelf A{$i}",
                    'location' => $locations[($i - 1) % count($locations)],
                    'description' => "Storage shelf {$code}.",
                ]
            );
        }
    }
}
