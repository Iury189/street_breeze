<?php

namespace App\Listeners;

use App\Events\MasterDeletedEvent;
use App\Models\LoggingModel;
use App\Models\MasterModel;
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
        $this->logModel = new LoggingModel();
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
        $nome = MasterModel::find($event->deleted_id)->nome;
        $this->logModel->create([
            'descricao_log' => "Registro ID Nº$event->dojo_id ($nome) da tabela dojos foi excluído, ocasionado pela ação de $nome_user ao excluir o registro ID Nº$event->deleted_id ($nome) da tabela masters.",
            'data' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
