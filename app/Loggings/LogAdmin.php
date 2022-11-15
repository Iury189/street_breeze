<?php

namespace App\Loggings;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class LogAdmin {

    public function logAdminPage()
    {
        $data_adm = Carbon::now()->format('d/m/Y H:i:s');
        $nome_adm = Auth::user()->name;
        $ip_adm = Request::ip();
        $mensagem = "Administrador(a) $nome_adm acessou a página exclusiva de adminstradores utilizando IP $ip_adm no seguinte horário: $data_adm.";
        Log::channel('logAdminPage')->info($mensagem);
        return $mensagem;
    }
}