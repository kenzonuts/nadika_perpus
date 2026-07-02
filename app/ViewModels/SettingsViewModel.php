<?php

declare(strict_types=1);

namespace App\ViewModels;

final class SettingsViewModel
{
    public function __construct(private readonly array $settings = []) {}

    public function toArray(): array
    {
        return $this->settings;
    }
}
