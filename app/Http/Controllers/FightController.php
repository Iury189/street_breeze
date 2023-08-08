<?php

namespace App\Http\Controllers;

use App\Exports\FightExport;
use App\Http\Requests\FightRequest;
use App\Loggings\LogFight;
use App\Models\FighterModel;
use App\Models\FightModel;
use App\Models\LoggingModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class FightController extends Controller
{
    public function __construct()
    {
        $this->logFight = new LogFight();
        $this->logModel = new LoggingModel();
    }

    public function index()
    {
        $fight = FightModel::paginate(5);
        $count_fight = DB::table('fights')->count('id');
        return view('fight.fight', compact(['fight','count_fight']));
    }

    public function create()
    {
        $fighter = FighterModel::all();
        return view('fight.create', compact('fighter'));
    }

    public function store(FightRequest $request)
    {
        $validacoes = $request->validated();
        $fighter1 = FighterModel::find($validacoes['fighter1_id']);
        $fighter2 = FighterModel::find($validacoes['fighter2_id']);
        $vencedor = rand(0, 1) == 0 ? $fighter1 : $fighter2;
        $validacoes['vencedor'] = $vencedor->id;
        $fight = FightModel::create($validacoes);
        if ($vencedor->id == $fighter1->id) {
            $fighter1->quantidade_vitorias += 1;
            $fighter2->quantidade_derrotas += 1;
            $mensagem = "Vencedor(a): $fighter1->nome com $fighter1->quantidade_vitorias vitórias e $fighter1->quantidade_derrotas derrotas "
            . "| Derrotado(a): $fighter2->nome com $fighter2->quantidade_vitorias vitórias e $fighter2->quantidade_derrotas derrotas";
        } else {
            $fighter2->quantidade_vitorias += 1;
            $fighter1->quantidade_derrotas += 1;
            $mensagem = "Vencedor(a): $fighter2->nome com $fighter2->quantidade_vitorias vitórias e $fighter2->quantidade_derrotas derrotas "
            ."| Derrotado(a): $fighter1->nome com $fighter1->quantidade_vitorias vitórias e $fighter1->quantidade_derrotas derrotas";
        }
        $fighter1->save();
        $fighter2->save();
        $this->logModel->create([
            'descricao_log' => $this->logFight->logCreateFight(),
            'relacao' => "Luta ID N°$fight->id está presente no sistema ($mensagem).",
        ]);
        return redirect('fight')->with('success-store',"Luta ID N°$fight->id está presente no sistema.");
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $this->logModel->create([
            'descricao_log' => $this->logFight->logDeleteFight(),
            'relacao' => "Luta ID N°$id não está mais presente no sistema.",
        ]);
        FightModel::where('id',$id)->delete();
        return redirect('fight')->with('success-destroy',"Luta ID N°$id não está mais presente no sistema.");
    }

    public function fightPDF($id)
    {
        $fight = FightModel::where('id', $id)->first();
        $pdf = PDF::loadView('fight.relatorio_simplificado_pdf', compact(['fight']));

        return $pdf->setPaper('A4')->stream("Fight ID Nº$id.pdf");
    }

    public function fightExcel($id)
    {
        $fight = FightModel::findOrFail($id);

        $nome_arquivo = "Fight-nº$fight->id.xls"; // Gera arquivo XLS
        $arquivo = Excel::raw(new FightExport($fight), \Maatwebsite\Excel\Excel::XLS);

        return response($arquivo, 200, [ // Retorna uma resposta HTTP com o arquivo XLS para download
            'Content-Type' => 'application/vnd.ms-excel',
            'Content-Disposition' => 'attachment; filename="' . $nome_arquivo . '"'
        ]);
    }

}
