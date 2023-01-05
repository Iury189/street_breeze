<?php

namespace App\Listeners;

use App\Events\MasterDeletedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MasterDeletedEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\MasterDeletedEvent  $event
     * @return void
     */
    public function handle(MasterDeletedEvent $event)
    {
        $nome_user = Auth::user()->name;
        DB::table('dojos')->where('master_id', $event->deleted_id)->delete();
        DB::table('logs_deletions')->insert([
            'descricao' => "Foi automaticamente excluído da tabela dojos o ID do Master Nº$event->deleted_id ocasionado pela ação de $nome_user em excluir esse registro da tabela masters.",
            'data' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
