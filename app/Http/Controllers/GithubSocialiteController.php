<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoggingModel;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class GithubSocialiteController extends Controller
{
    /**
    * Redireciona o usuário para a página de autenticação do GitHub, onde consegue fazer login e autorizar o acesso.
    */
    public function redirectGithubLogin()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
    * URL de retorno de chamada que o GitHub faz para redirecionar o usuário ao dashboard.
    */
    public function callbackGithubLogin(Request $request)
    {
        try {

            $user = Socialite::driver('github')->user();

            $user = User::firstOrCreate([
                'email' => $user->email
            ], [
                'name' => $user->name,
                'password' => Hash::make(Str::random(24))
            ]);

            Auth::login($user, true);

            $data = Carbon::now()->format('d/m/Y H:i:s');
            $nome_user = $user->name;
            $ip_user = $request->ip();
            $mensagem = "{$nome_user} vinculou sua conta GitHub para realizar login no sistema utilizando IP {$ip_user} em {$data}.";
            Log::channel('logGitHubLogin')->info($mensagem);

            $log = new LoggingModel();
            $log->descricao_log = $mensagem;
            $log->relacao = '';
            $log->save();

            return redirect('dashboard');

        } catch (\Exception $e) {
            return redirect('login')->with('success-destroy', "Não é possível autenticar uma conta GitHub que não se encontra atrelada ao seu registro.");
        }
    }
}
