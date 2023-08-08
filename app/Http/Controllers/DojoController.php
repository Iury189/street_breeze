<?php

namespace App\Http\Controllers;

use App\Loggings\LogDojo;
use App\Models\DojoModel;
use App\Models\LoggingModel;
use Illuminate\Http\Request;
use App\Http\Requests\DojoRequest;
use Illuminate\Support\Facades\DB;

class DojoController extends Controller
{
    public function __construct()
    {
        $this->logDojo = new LogDojo();
        $this->logModel = new LoggingModel();
    }

    public function index()
    {
        $dojo = DojoModel::paginate(5);
        $count_dojo = DB::table('dojos')->count('id');
        return view('dojo.dojo', compact(['dojo','count_dojo']));
    }

    public function create()
    {
        $fighter = DB::table('fighters')->select('fighters.id','fighters.nome')
        ->join('dojos','fighters.id','=','dojos.fighter_id','LEFT OUTER')
        ->whereNull('dojos.fighter_id')->get();
        $master = DB::table('masters')->select('id','nome')->get();
        return view('dojo.create', compact(['fighter','master']));
    }

    public function store(DojoRequest $request)
    {
        $validacoes = $request->validated();
        $dojo = DojoModel::create($validacoes);
        $this->logModel->create([
            'descricao_log' => $this->logDojo->logCreateDojo(),
            'relacao' => "Dojô ID N°$dojo->id está presente no sistema.",
        ]);
        $dojo->update($validacoes);
        return redirect('dojo')->with('success-store',"Dojô ID N°$dojo->id está presente no sistema.");
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $dojo = DojoModel::find($id);
        $fighter = DB::table('fighters')->select('fighters.id','fighters.nome')
        ->join('dojos','fighters.id','=','dojos.fighter_id','LEFT OUTER')
        ->whereNull('dojos.fighter_id')->get();
        $master = DB::table('masters')->select('id','nome')->get();
        return view('dojo.update', compact(['dojo','fighter','master']));
    }

    public function update(DojoRequest $request, $id)
    {
        $validacoes = $request->validated();
        DojoModel::where('id',$id)->update($validacoes);
        $this->logModel->create([
            'descricao_log' => $this->logDojo->logUpdateDojo(),
            'relacao' => "Dojô ID N°$id obteve atualizações em suas informações.",
        ]);
        return redirect('dojo')->with('success-update',"Dojô ID N°$id obteve atualizações em suas informações.");
    }

    public function destroy($id)
    {
        $this->logModel->create([
            'descricao_log' => $this->logDojo->logDeleteDojo(),
            'relacao' => "Dojô ID N°$id não está mais presente no sistema.",
        ]);
        DojoModel::where('id',$id)->delete();
        return redirect('dojo')->with('success-destroy',"Dojô ID N°$id não está mais presente no sistema.");
    }
}
