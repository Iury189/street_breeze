<?php

namespace App\Listeners;

use App\Events\FighterDeletedEvent;
use App\Models\FighterModel;
use App\Models\LoggingModel;
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
        $this->logModel = new LoggingModel();
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
        $nome = FighterModel::find($event->deleted_id)->nome;
        $this->logModel->create([
            'descricao_log' => "Registro ID Nº$event->dojo_id ($nome) da tabela dojos foi excluído, ocasionado pela ação de $nome_user ao excluir o registro ID Nº$event->deleted_id ($nome) da tabela fighters.",
            'data' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
