<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\LoggingModel;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Rules\NoSpacesPasswordRule;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    public function __construct()
    {
        $this->logModel = new LoggingModel();
    }
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults(), new NoSpacesPasswordRule],
        ],
        [
            'name.required' => 'O nome do usuário é obrigatório.',
            'name.max' => 'O nome do usuário deve conter no máximo 255 caracteres.',
            'email.required' => 'O e-mail do usuário é obrigatório.',
            'email.email' => 'O e-mail do usuário deve conter um endereço válido.',
            'email.max' => 'O e-mail do usuário deve conter no máximo 255 caracteres.',
            'email.unique' => 'Já existe um usuário com esse e-mail.',
            'password.required' => 'A senha do usuário é obrigatória.',
            'password.confirmed' => 'A senha e a confirmação da senha não coincidem.',
            'password.min' => 'A senha deve conter no mínimo 8 caracteres.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        $data = Carbon::now()->format('d/m/Y H:i:s');
        $nome_user = $user->name;
        $ip_user = request()->ip();
        $mensagem = "{$nome_user} se registrou utilizando o IP {$ip_user} em {$data}.";
        Log::channel('logRegisterUser')->info($mensagem);

        $this->logModel->create([
            'descricao_log' => $mensagem,
            'relacao' => '',
        ]);

        Auth::login($user);
        return redirect(RouteServiceProvider::HOME);
    }
}
