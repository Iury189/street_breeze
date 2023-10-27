<?php

namespace App\Loggings;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Carbon\Carbon;

class LogMaster {

    public function logCreateMaster() // Work
    {
        $data = Carbon::now()->format('d/m/Y H:i:s');
        $nome_user = Auth::user()->name;
        $ip_user = Request::ip();
        $mensagem = "$nome_user cadastrou um Master utilizando IP $ip_user em $data.";
        Log::channel('logCreateMaster')->notice($mensagem);
        return $mensagem;
    }

    public function logUpdateMaster() // Work
    {
        $data = Carbon::now()->format('d/m/Y H:i:s');
        $nome_user = Auth::user()->name;
        $ip_user = Request::ip();
        $mensagem = "$nome_user atualizou um Master utilizando IP $ip_user em $data.";
        Log::channel('logUpdateMaster')->notice($mensagem);
        return $mensagem;
    }

    public function logDeleteMaster() // Work
    {
        $data = Carbon::now()->format('d/m/Y H:i:s');
        $nome_user = Auth::user()->name;
        $ip_user = Request::ip();
        $mensagem = "$nome_user deletou um Master utilizando IP $ip_user em $data.";
        return $mensagem;
    }

}
