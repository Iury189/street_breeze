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
        $ip_user = Request::ip();
        $mensagem = "$nome_user cadastrou um Fighter utilizando IP $ip_user em $data.";
        Log::channel('logCreateFighter')->notice($mensagem);
        return $mensagem;
    }

    public function logUpdateFighter() // Work
    {
        $data = Carbon::now()->format('d/m/Y H:i:s');
        $nome_user = Auth::user()->name;
        $ip_user = Request::ip();
        $mensagem = "$nome_user atualizou um Fighter utilizando IP $ip_user em $data.";
        Log::channel('logUpdateFighter')->notice($mensagem);
        return $mensagem;
    }

    public function logDeleteFighter() // Work
    {
        $data = Carbon::now()->format('d/m/Y H:i:s');
        $nome_user = Auth::user()->name;
        $ip_user = Request::ip();
        $mensagem = "$nome_user deletou um Fighter utilizando IP $ip_user em $data.";
        Log::channel('logDeleteFighter')->notice($mensagem);
        return $mensagem;
    }

}
