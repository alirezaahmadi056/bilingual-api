<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Article;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Melipayamak\MelipayamakApi;
use Illuminate\Support\Facades\Http;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $user = User::where("phone",$request->phone)->first();
        if($user == null) {
            return redirect()->back()->withErrors("حساب شما تایید نشد!");
        }
        
        
        if ($user->superuser == 1) {
            $request->authenticate();

            $request->session()->regenerate();

            return redirect(route("home"));
        }
        return redirect(route("login"));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
