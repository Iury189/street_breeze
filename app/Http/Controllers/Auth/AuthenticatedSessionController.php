<?php

namespace App\Http\Controllers\Auth;

use App\Models\LoggingModel;
use Illuminate\Http\Request;
use App\Loggings\LogUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;

class AuthenticatedSessionController extends Controller
{
    public function __construct()
    {
        $this->logUser = new LogUser();
        $this->logModel = new LoggingModel();
    }

    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();
        $request->session()->regenerate();
        $this->logModel->create([
            'descricao_log' => $this->logUser->logLogin(),
            'relacao' => '',
        ]);
        //return redirect()->intended(RouteServiceProvider::HOME);
        return redirect('/dashboard');
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $this->logModel->create([
            'descricao_log' => $this->logUser->logLogout(),
            'relacao' => '',
        ]);
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
