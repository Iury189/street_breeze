<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Models\LoggingModel;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * Summary of GoogleSocialiteController
 */
class GoogleSocialiteController extends Controller
{
    // Redireciona o usuário para a página de autenticação do Google, onde consegue fazer login e autorizar o acesso.
    public function redirectGoogleLogin()
    {
        return Socialite::driver('google')->redirect();
    }

    // URL de retorno de chamada que o Google faz para redirecionar o usuário ao dashboard.
    public function callbackGoogleLogin(Request $request)
    {
        try {

            $user = Socialite::driver('google')->user();

            $user = User::firstOrCreate([
                'email' => $user->email
            ], [
                'name' => $user->name,
                'password' => Hash::make(Str::random(24))
            ]);

            Auth::login($user, true);

            $data = Carbon::now()->format('d/m/Y H:i:s');
            $nome_user = $user->name;
            $tipo_user = $user->role;
            $ip_user = $request->ip();
            $mensagem = $tipo_user === 1 ? "Administrador(a) {$nome_user} vinculou sua conta Google para realizar login no sistema utilizando IP {$ip_user} em {$data}." :
            "Usuário(a) {$nome_user} vinculou sua conta Google para realizar login no sistema utilizando IP {$ip_user} em {$data}.";
            Log::channel('logGoogleLogin')->info($mensagem);

            $log = new LoggingModel();
            $log->descricao_log = $mensagem;
            $log->relacao = '';
            $log->save();

            return redirect('dashboard');

        } catch (\Exception $e) {
            return redirect('login')->with('success-destroy', "Não é possível autenticar uma conta Google que não se encontra atrelada ao seu registro.");
        }
    }

    // // Redireciona o usuário para a página de autenticação do Google, onde consegue fazer registro e autorizar o acesso.
    // /**
    //  * Summary of redirectGoogleRegister
    //  * @return mixed
    //  */
    // public function redirectGoogleRegister()
    // {
    //     return Socialite::driver('google')->redirect();
    // }

    // // URL de retorno de chamada que o Google faz para redirecionar o usuário ao dashboard.
    // /**
    //  * Summary of callbackGoogleRegister
    //  * @param Request $request
    //  * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|mixed
    //  */
    // public function callbackGoogleRegister(Request $request)
    // {
    //     $user = Socialite::driver('google')->user();

    //     $existe_user = User::where('email', $user->email)->first();

    //     if ($existe_user) {

    //         return redirect('login')->with('success-destroy',"$user->name já possui já vinculou esse e-mail ao se registrar no sistema.");

    //     } else {

    //         $new_user = new User();
    //         $new_user->name = $user->name;
    //         $new_user->email = $user->email;
    //         $new_user->password = Hash::make(Str::random(24));
    //         $new_user->save();

    //         Auth::login($new_user, true);

    //     }
    //     return redirect(RouteServiceProvider::HOME);
    // }
}
