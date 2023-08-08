<?php

namespace App\Http\Controllers;

use App\Events\MasterDeletedEvent;
use App\Loggings\LogMaster;
use App\Models\DojoModel;
use App\Models\MasterModel;
use App\Models\LoggingModel;
use App\Models\NacionalidadeModel;
use App\Models\TipoSanguineoModel;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\MasterRequest;

class MasterController extends Controller
{
    public function __construct()
    {
        $this->logMaster = new LogMaster();
        $this->logModel = new LoggingModel();
    }

    public function index()
    {
        $master = MasterModel::paginate(5);
        $count_master = DB::table('masters')->count('nome');
        return view('master.master', compact(['master','count_master']));
    }

    public function create()
    {
        $nacionalidade = NacionalidadeModel::orderBy('descricao')->get();
        $tipo_sanguineo = TipoSanguineoModel::all();
        return view('master.create', compact(['nacionalidade','tipo_sanguineo']));
    }

    public function store(MasterRequest $request)
    {
        $validacoes = array_map('trim', $request->validated());
        $validacoes['passaporte'] = Str::upper($request->passaporte);
        MasterModel::create($validacoes);
        $this->logModel->create([
            'descricao_log' => $this->logMaster->logCreateMaster(),
            'relacao' => "Master {$validacoes['nome']} agora está presente no sistema.",
        ]);
        return redirect('master')->with('success-store',"{$validacoes['nome']} está presente no sistema.");
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $master = MasterModel::find($id);
        $nacionalidade = NacionalidadeModel::orderBy('descricao')->get();
        $tipo_sanguineo = TipoSanguineoModel::all();
        return view('master.update', compact(['master','nacionalidade','tipo_sanguineo']));
    }

    public function update(MasterRequest $request, $id)
    {
        $validacoes = array_map('trim', $request->validated());
        $validacoes['passaporte'] = Crypt::encryptString(Str::upper($request->passaporte));
        MasterModel::where('id',$id)->update($validacoes);
        $this->logModel->create([
            'descricao_log' => $this->logMaster->logUpdateMaster(),
            'relacao' => "Master {$validacoes['nome']} obteve atualizações em suas informações.",
        ]);
        return redirect('master')->with('success-update',"{$validacoes['nome']} obteve atualizações em suas informações.");
    }


    public function destroy($id)
    {
        $nome = DB::table('masters')->where('id','=',$id)->value('nome');
        $this->logModel->create([
            'descricao_log' => $this->logMaster->logDeleteMaster(),
            'relacao' => "Master $nome não está mais presente no sistema.",
        ]);
        $dojo = DojoModel::where('master_id',$id)->pluck('id');
        if ($dojo != null && $dojo->count() > 0) {
            foreach($dojo as $d){
                Event::dispatch(new MasterDeletedEvent($id, $d));
            }
        }
        MasterModel::where('id',$id)->delete();
        return redirect('master')->with('success-destroy',"$nome não está mais presente no sistema.");
    }
}
