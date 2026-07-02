<?php

namespace Database\Seeders;

use App\Models\SystemSetting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'library_name', 'value' => 'Nadika Library', 'group' => 'general'],
            ['key' => 'library_tagline', 'value' => 'Smart Secure Library Management', 'group' => 'general'],
            ['key' => 'contact_email', 'value' => 'contact@library.local', 'group' => 'general'],
            ['key' => 'contact_phone', 'value' => '+6281234567000', 'group' => 'general'],
            ['key' => 'library_address', 'value' => '123 Library Street, Jakarta', 'group' => 'general'],
            ['key' => 'borrow_limit', 'value' => '3', 'group' => 'library'],
            ['key' => 'loan_duration', 'value' => '14', 'group' => 'library'],
            ['key' => 'fine_per_day', 'value' => '5000', 'group' => 'library'],
            ['key' => 'email_notifications', 'value' => 'true', 'group' => 'notifications'],
            ['key' => 'maintenance_mode', 'value' => 'false', 'group' => 'system'],
        ];

        foreach ($settings as $setting) {
            SystemSetting::query()->updateOrCreate(
                ['key' => $setting['key']],
                [
                    'value' => $setting['value'],
                    'group' => $setting['group'],
                ]
            );
        }
    }
}
