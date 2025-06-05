<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Mails\ResetPasswordMail;
use App\Models\PasswordResetRequest;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Ezacorp\Ezamailer\Facades\EzaMailer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
use Ramsey\Uuid\Uuid;

class AuthController extends Controller
{
    public function login(): Response
    {
        return Inertia::render('Auth/Login');
    }

    public function processLogin(LoginRequest $request)
    {

        $request->authenticate();

        return redirect()->intended(route('index'));
    }

    public function register(): Response
    {
        return Inertia::render('Auth/Register');
    }

    public function processRegister(RegisterRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('auth.login');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        return redirect()->route('auth.login');
    }
}
