<?php

namespace App\Loggings;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class LogAdmin {

    public function logAdminPage()
    {
        $adm = Auth::user()->name;
        $data_adm = Carbon::now()->format('d/m/Y H:i:s');
        Log::channel('logPageAdmin')->info("Administrador(a) $adm acessou a página exclusiva de adminstradores no seguinte horário: $data_adm.");
    }
}