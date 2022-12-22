<?php

namespace App\Http\Controllers;

use App\Loggings\LogDojo;
use App\Models\DojoModel;
use App\Models\MasterModel;
use App\Models\FighterModel;
use App\Models\LoggingModel;
use Illuminate\Http\Request;
use App\Http\Requests\DojoRequest;
use Illuminate\Support\Facades\DB;

class DojoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['index','create','store','edit','update','destroy']);
        $this->logDojo = new LogDojo();
        $this->logModel = new LoggingModel();
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
        $this->logModel->create([
            'descricao_log' => $this->logDojo->logCreateDojo(),
            'relacao' => "Um novo dojô agora está presente no sistema.",
        ]);
        return redirect('dojo')->with('success-store',"Dojo está presente no sistema.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $this->logModel->create([
            'descricao_log' => $this->logDojo->logUpdateDojo(),
            'relacao' => "Dojô ID N°$id obteve atualizações em suas informações.",
        ]);
        return redirect('dojo')->with('success-update',"Dojô ID N°$id obteve atualizações em suas informações.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = DB::table('dojos')->where('id','=',$id)->value('id');
        $this->logModel->create([
            'descricao_log' => $this->logDojo->logDeleteDojo(),
            'relacao' => "Dojô ID N°$id não está mais presente no sistema.",
        ]);
        DojoModel::where('id',$id)->delete();
        return redirect('dojo')->with('success-destroy',"Dojô ID N°$id não está mais presente no sistema.");
    }
}
