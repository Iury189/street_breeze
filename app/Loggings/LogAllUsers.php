<?php

namespace App\Loggings;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class LogAllUsers {

    public function logLogin()
    {
        $data_user = Carbon::now()->format('d/m/Y H:i:s');
        $nome_user = Auth::user()->name;
        $tipo_user = Auth::user()->role;
        $ip_user = Request::ip();
        $mensagem = $tipo_user === 1 ? "Administrador(a) $nome_user realizou login utilizando IP $ip_user em $data_user." : "Usuário(a) $nome_user realizou login utilizando IP $ip_user em $data_user.";
        Log::channel('logLogin')->info($mensagem);
        return $mensagem;
    }

    public function logLogout()
    {
        $data_user = Carbon::now()->format('d/m/Y H:i:s');
        $nome_user = Auth::user()->name;
        $tipo_user = Auth::user()->role;
        $ip_user = Request::ip();
        $mensagem = $tipo_user === 1 ? "Administrador(a) $nome_user realizou logout utilizando IP $ip_user em $data_user." : "Usuário(a) $nome_user realizou logout utilizando IP $ip_user em $data_user.";
        Log::channel('logLogout')->info($mensagem);
        return $mensagem;
    }
}