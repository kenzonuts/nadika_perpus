<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ConfirmablePasswordController extends Controller
{
    public function create(): View { return view('auth.confirm-password'); }

    public function show(): View { return view('auth.confirm-password'); }

    public function store(Request $request): RedirectResponse
    {
        if (! Auth::guard('web')->validate(['email' => $request->user()->email, 'password' => $request->input('password')])) {
            throw ValidationException::withMessages(['password' => __('auth.password')]);
        }

        $request->session()->passwordConfirmed();

        return redirect()->intended();
    }
}
