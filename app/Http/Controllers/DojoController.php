<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Loggings\LogDojo;
use App\Models\DojoModel;
use App\Models\MasterModel;
use App\Models\FighterModel;
use App\Models\LoggingModel;
use Illuminate\Http\Request;
use App\Http\Requests\DojoRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DojoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['index','create','store','edit','update','destroy']);
        $this->logDojo = new LogDojo();
        $this->loggingModel = new LoggingModel();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dojo = DojoModel::paginate(5);
        $count_dojo = DB::table('dojos')->count('id');
        return view('dojo.dojo', compact(['dojo','count_dojo']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fighter = FighterModel::get(['id','nome']);
        $master = MasterModel::get(['id','nome']);
        return view('dojo.create', compact(['fighter','master']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DojoRequest $request)
    {
        $validacoes = $request->validated();
        DojoModel::create($validacoes);
        $this->loggingModel->create([
            'descricao_log' => $this->logDojo->logCreateDojo(), 
            'metodo_operacao' => 'store',
            'relacao' => "Um novo dojô agora está presente no sistema.",
        ]);
        return redirect('dojo')->with('success-store','Dojo está presente no sistema.');  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dojo = DojoModel::find($id);
        $this->authorize('showAdmin', Auth::user());
        $fighter = FighterModel::get(['id','nome']);
        $master = MasterModel::get(['id','nome']);
        return view('dojo.show', compact(['dojo','fighter','master']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dojo = DojoModel::find($id);
        $fighter = FighterModel::get(['id','nome']);
        $master = MasterModel::get(['id','nome']);
        return view('dojo.update', compact(['dojo','fighter','master']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DojoRequest $request, $id)
    {
        $validacoes = $request->validated();
        DojoModel::where('id',$id)->update($validacoes);
        $id_dojo = DB::table('dojos')->where('id','=',$id)->value('id');
        $this->loggingModel->create([
            'descricao_log' => $this->logDojo->logUpdateDojo(), 
            'metodo_operacao' => 'update',
            'relacao' => "Dojô ID $id_dojo obteve atualizações em suas informações.",
        ]);
        return redirect('dojo')->with('success-update','O dojo obteve atualizações em suas informações.');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id_dojo = DB::table('dojos')->where('id','=',$id)->value('id');
        $this->loggingModel->create([
            'descricao_log' => $this->logDojo->logDeleteDojo(), 
            'metodo_operacao' => 'destroy',
            'relacao' => "Dojô ID $id_dojo foi excluído(a) do sistema.",
        ]);
        DojoModel::where('id',$id)->delete();
        return redirect('dojo')->with('success-destroy','Dojo não está mais presente no sistema.');
    }
}
