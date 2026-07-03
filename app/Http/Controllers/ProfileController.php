<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\PasswordUpdateRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Services\ProfileService;
use App\Services\StatisticsService;
use App\ViewModels\ProfileViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(Request $request): View
    {
        return view('profile.index', (new ProfileViewModel($request->user()))->toArray());
    }

    public function security(Request $request): View
    {
        return view('profile.security', (new ProfileViewModel($request->user()))->toArray());
    }

    public function activity(Request $request, StatisticsService $statistics): View
    {
        return view('profile.activity', array_merge(
            (new ProfileViewModel($request->user()))->toArray(),
            [
                'activityTimeline' => $statistics->recentActivity(8, $request->user()->id),
            ]
        ));
    }

    public function update(ProfileUpdateRequest $request, ProfileService $service): RedirectResponse
    {
        $service->updateProfile($request->user(), $request->validated());

        return back();
    }

    public function updatePassword(PasswordUpdateRequest $request, ProfileService $service): RedirectResponse
    {
        $service->updatePassword($request->user(), $request->validated()['current_password'], $request->validated()['password']);

        return back();
    }
}
