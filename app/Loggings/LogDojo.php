<?php

namespace App\Loggings;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Carbon\Carbon;

class LogDojo {

    public function logCreateDojo() // Work
    {
        $data = Carbon::now()->format('d/m/Y H:i:s');
        $nome_user = Auth::user()->name;
        $tipo_user = Auth::user()->role;
        $ip_user = Request::ip();
        $mensagem = $tipo_user === 1 ? "Administrador(a) $nome_user cadastrou um treinamento utilizando IP $ip_user em $data." : "Usuário(a) $nome_user cadastrou um treinamento utilizando IP $ip_user em $data.";
        Log::channel('logCreateDojo')->notice($mensagem);
        return $mensagem;
    }

    public function logUpdateDojo() // Work
    {
        $data = Carbon::now()->format('d/m/Y H:i:s');
        $nome_user = Auth::user()->name;
        $tipo_user = Auth::user()->role;
        $ip_user = Request::ip();
        $mensagem = $tipo_user === 1 ? "Administrador(a) $nome_user atualizou um treinamento utilizando IP $ip_user em $data." : "Usuário(a) $nome_user atualizou um treinamento utilizando IP $ip_user em $data.";
        Log::channel('logUpdateDojo')->notice($mensagem);
        return $mensagem;
    }

    public function logDeleteDojo() // Work
    {
        $data = Carbon::now()->format('d/m/Y H:i:s');
        $nome_user = Auth::user()->name;
        $tipo_user = Auth::user()->role;
        $ip_user = Request::ip();
        $mensagem = $tipo_user === 1 ? "Administrador(a) $nome_user deletou um treinamento utilizando IP $ip_user em $data." : "Usuário(a) $nome_user deletou um treinamento utilizando IP $ip_user em $data.";
        Log::channel('logDeleteDojo')->notice($mensagem);
        return $mensagem;
    }
    
}