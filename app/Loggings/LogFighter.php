<?php

namespace App\Loggings;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Carbon\Carbon;

class LogFighter {

    public function logCreateFighter() // Work
    {
        $data = Carbon::now()->format('d/m/Y H:i:s');
        $nome_user = Auth::user()->name;
        $tipo_user = Auth::user()->role;
        $ip_user = Request::ip();
        $mensagem = $tipo_user === 1 ? "Administrador(a) $nome_user cadastrou um Fighter utilizando IP $ip_user em $data." : "Usuário(a) $nome_user cadastrou um Fighter utilizando IP $ip_user em $data.";
        Log::channel('logCreateFighter')->notice($mensagem);
        return $mensagem;
    }

    public function logUpdateFighter() // Work
    {
        $data = Carbon::now()->format('d/m/Y H:i:s');
        $nome_user = Auth::user()->name;
        $tipo_user = Auth::user()->role;
        $ip_user = Request::ip();
        $mensagem = $tipo_user === 1 ? "Administrador(a) $nome_user atualizou um Fighter utilizando IP $ip_user em $data." : "Usuário(a) $nome_user atualizou um Fighter utilizando IP $ip_user em $data.";
        Log::channel('logUpdateFighter')->notice($mensagem);
        return $mensagem;
    }

    public function logDeleteFighter() // Work
    {
        $data = Carbon::now()->format('d/m/Y H:i:s');
        $nome_user = Auth::user()->name;
        $tipo_user = Auth::user()->role;
        $ip_user = Request::ip();
        $mensagem = $tipo_user === 1 ? "Administrador(a) $nome_user deletou um Fighter utilizando IP $ip_user em $data." : "Usuário(a) $nome_user deletou um Fighter utilizando IP $ip_user em $data.";
        Log::channel('logDeleteFighter')->notice($mensagem);
        return $mensagem;
    }
    
}