<?php

namespace App\Http\Controllers;

use App\Events\FighterDeletedEvent;
use App\Loggings\LogFighter;
use App\Models\DojoModel;
use App\Models\FighterModel;
use App\Models\LoggingModel;
use App\Models\NacionalidadeModel;
use App\Models\TipoSanguineoModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\FighterRequest;

class FighterController extends Controller
{
    public function __construct()
    {
        $this->logFighter = new LogFighter();
        $this->logModel = new LoggingModel();
    }

    public function index()
    {
        $fighter = FighterModel::paginate(5);
        $count_fighter = DB::table('fighters')->count();
        return view('fighter.fighter', compact(['fighter','count_fighter']));
    }

    public function create()
    {
        $nacionalidade = NacionalidadeModel::orderBy('descricao')->get();
        $tipo_sanguineo = TipoSanguineoModel::all();
        return view('fighter.create', compact(['nacionalidade','tipo_sanguineo']));
    }

    public function store(FighterRequest $request)
    {
        $validacoes = array_map('trim', $request->validated());
        $validacoes['passaporte'] = Str::upper($request->passaporte);
        FighterModel::create($validacoes);
        $this->logModel->create([
            'descricao_log' => $this->logFighter->logCreateFighter(),
            'relacao' => "Fighter {$validacoes['nome']} agora está presente no sistema.",
        ]);
        return redirect('fighter')->with('success-store',"{$validacoes['nome']} está presente no sistema.");
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $fighter = FighterModel::find($id);
        $nacionalidade = NacionalidadeModel::orderBy('descricao')->get();
        $tipo_sanguineo = TipoSanguineoModel::all();
        return view('fighter.update', compact(['fighter','nacionalidade','tipo_sanguineo']));
    }

    public function update(FighterRequest $request, $id)
    {
        $validacoes = array_map('trim', $request->validated());
        $validacoes['passaporte'] = Crypt::encryptString(Str::upper($request->passaporte));
        FighterModel::where('id',$id)->update($validacoes);
        $this->logModel->create([
            'descricao_log' => $this->logFighter->logUpdateFighter(),
            'relacao' => "Fighter {$validacoes['nome']} obteve atualizações em suas informações.",
        ]);
        return redirect('fighter')->with('success-update',"{$validacoes['nome']} obteve atualizações em suas informações.");
    }

    public function destroy($id)
    {
        $nome = DB::table('fighters')->where('id','=',$id)->value('nome');
        $this->logModel->create([
            'descricao_log' => $this->logFighter->logDeleteFighter(),
            'relacao' => "Fighter $nome não está mais presente no sistema.",
        ]);
        $dojo = DojoModel::where('fighter_id',$id)->pluck('id');
        if ($dojo != null && $dojo->count() > 0) {
            foreach($dojo as $d){
                Event::dispatch(new FighterDeletedEvent($id, $d));
            }
        }
        FighterModel::where('id',$id)->delete();
        return redirect('fighter')->with('success-destroy',"$nome não está mais presente no sistema.");
    }

    public function searchFighter(Request $request)
    {
        $filtro = $request->input('search');
        $count_fighter = DB::table('fighters')->count();
        $fighter = FighterModel::query()->where('nome', 'LIKE', "%$filtro%")->paginate(5);
        return view('fighter.fighter', compact(['fighter','count_fighter']));
    }
}
