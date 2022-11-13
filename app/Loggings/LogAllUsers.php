<?php

namespace App\Loggings;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class LogAllUsers {

    public function logLogin()
    {
        $user = Auth::user()->name;
        $tipo_user = Auth::user()->role;
        Log::channel('logLogin')->info($tipo_user === 1 ? "Administrador(a) $user realizou login." : "Usuário(a) $user realizou login.");
    }

    public function logLogout()
    {
        $user = Auth::user()->name;
        $tipo_user = Auth::user()->role;
        Log::channel('logLogout')->info($tipo_user === 1 ? "Administrador(a) $user realizou logout." : "Usuário(a) $user realizou logout.");
    }
}