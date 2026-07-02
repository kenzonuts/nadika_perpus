<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSettingsRequest;
use App\Services\SettingsService;
use App\ViewModels\SettingsViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SettingsController extends Controller
{
    public function general(SettingsService $service): View
    {
        return view('settings.general', (new SettingsViewModel($service->group('general')))->toArray());
    }

    public function library(SettingsService $service): View
    {
        return view('settings.library', (new SettingsViewModel($service->group('library')))->toArray());
    }

    public function security(SettingsService $service): View
    {
        return view('settings.security', (new SettingsViewModel($service->group('security')))->toArray());
    }

    public function notifications(SettingsService $service): View
    {
        return view('settings.notifications', (new SettingsViewModel($service->group('notifications')))->toArray());
    }

    public function system(SettingsService $service): View
    {
        return view('settings.system', (new SettingsViewModel($service->group('system')))->toArray());
    }

    public function update(UpdateSettingsRequest $request, SettingsService $service): RedirectResponse
    {
        $data = $request->validated();
        $service->updateGroup($data['group'], $data['settings']);

        return back();
    }
}
