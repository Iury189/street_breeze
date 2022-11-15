<?php

namespace App\Http\Controllers\Auth;

use App\Models\LoggingModel;
use Illuminate\Http\Request;
use App\Loggings\LogAllUsers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    public function __construct()
    {
        $this->logAllUsers = new LogAllUsers();
        $this->loggingModel = new LoggingModel();    
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
        $this->loggingModel->create([
            'descricao' => $this->logAllUsers->logLogin(), 
            'metodo_operacao' => 'login',
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
        $this->loggingModel->create([
            'descricao' => $this->logAllUsers->logLogout(), 
            'metodo_operacao' => 'logout',
        ]);
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
