<?php

namespace App\Listeners;

use App\Events\FighterDeletedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FighterDeletedEventListener
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
     * @param  \App\Events\FighterDeletedEvent  $event
     * @return void
     */
    public function handle(FighterDeletedEvent $event)
    {
        $nome_user = Auth::user()->name;
        DB::table('dojos')->where('fighter_id', $event->deleted_id)->delete();
        DB::table('logs_deletions')->insert([
            'descricao' => "Foi automaticamente excluído da tabela dojos o ID do Fighter Nº$event->deleted_id ocasionado pela ação de $nome_user em excluir esse registro da tabela fighters.",
            'data' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
