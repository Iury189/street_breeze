<?php

namespace App\Loggings;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class LogUser {

    public function logLogin() // Work
    {
        $data = Carbon::now()->format('d/m/Y H:i:s');
        $nome_user = Auth::user()->name;
        $ip_user = Request::ip();
        $mensagem = "$nome_user realizou login utilizando IP $ip_user em $data.";
        Log::channel('logLogin')->info($mensagem);
        return $mensagem;
    }

    public function logLogout() // Work
    {
        $data = Carbon::now()->format('d/m/Y H:i:s');
        $nome_user = Auth::user()->name;
        $ip_user = Request::ip();
        $mensagem = "$nome_user realizou logout utilizando IP $ip_user em $data.";
        Log::channel('logLogout')->info($mensagem);
        return $mensagem;
    }

    public function logUpdatePassword() // Work
    {
        $data = Carbon::now()->format('d/m/Y H:i:s');
        $nome_user = Auth::user()->name;
        $ip_user = Request::ip();
        $mensagem = "$nome_user alterou sua senha utilizando IP $ip_user em $data.";
        Log::channel('logUpdatePassword')->info($mensagem);
        return $mensagem;
    }

    public function logUpdateEmail() // Work
    {
        $data = Carbon::now()->format('d/m/Y H:i:s');
        $nome_user = Auth::user()->name;
        $ip_user = Request::ip();
        $mensagem = "$nome_user alterou seu e-mail utilizando IP $ip_user em $data.";
        Log::channel('logUpdateEmail')->info($mensagem);
        return $mensagem;
    }

    public function logDeleteUser() // Work
    {
        $data = Carbon::now()->format('d/m/Y H:i:s');
        $nome_user = Auth::user()->name;
        $ip_user = Request::ip();
        $mensagem = "$nome_user excluiu seu cadastro no sistema utilizando IP $ip_user em $data.";
        Log::channel('logDeleteUser')->info($mensagem);
        return $mensagem;
    }

}
