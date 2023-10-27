<?php

namespace App\Loggings;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Carbon\Carbon;

class LogFight {

    public function logCreateFight() // Work
    {
        $data = Carbon::now()->format('d/m/Y H:i:s');
        $nome_user = Auth::user()->name;
        $ip_user = Request::ip();
        $mensagem = "$nome_user cadastrou uma utilizando IP $ip_user em $data.";
        Log::channel('logCreateFight')->notice($mensagem);
        return $mensagem;
    }

    public function logDeleteFight() // Work
    {
        $data = Carbon::now()->format('d/m/Y H:i:s');
        $nome_user = Auth::user()->name;
        $ip_user = Request::ip();
        $mensagem = "$nome_user deletou uma luta utilizando IP $ip_user em $data.";
        Log::channel('logDeleteFight')->notice($mensagem);
        return $mensagem;
    }

}
