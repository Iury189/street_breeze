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
        $tipo_user = Auth::user()->role;
        $ip_user = Request::ip();
        $mensagem = $tipo_user === 1 ? "Administrador(a) $nome_user cadastrou um Master utilizando IP $ip_user em $data." : "Usuário(a) $nome_user cadastrou um Master utilizando IP $ip_user em $data.";
        Log::channel('logCreateMaster')->notice($mensagem);
        return $mensagem;
    }

    public function logUpdateMaster() // Work
    {
        $data = Carbon::now()->format('d/m/Y H:i:s');
        $nome_user = Auth::user()->name;
        $tipo_user = Auth::user()->role;
        $ip_user = Request::ip();
        $mensagem = $tipo_user === 1 ? "Administrador(a) $nome_user atualizou um Master utilizando IP $ip_user em $data." : "Usuário(a) $nome_user atualizou um Master utilizando IP $ip_user em $data.";
        Log::channel('logUpdateMaster')->notice($mensagem);
        return $mensagem;
    }

    public function logDeleteMaster() // Work
    {
        $data = Carbon::now()->format('d/m/Y H:i:s');
        $nome_user = Auth::user()->name;
        $tipo_user = Auth::user()->role;
        $ip_user = Request::ip();
        $mensagem = $tipo_user === 1 ? "Administrador(a) $nome_user deletou um Master utilizando IP $ip_user em $data." : "Usuário(a) $nome_user deletou um Master utilizando IP $ip_user em $data.";
        Log::channel('logDeleteMaster')->notice($mensagem);
        return $mensagem;
    }
    
}