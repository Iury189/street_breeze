<?php

namespace App\Http\Controllers;

use App\Loggings\LogMaster;
use App\Models\MasterModel;
use App\Models\LoggingModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\MasterRequest;

class MasterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['index','create','store','edit','update','destroy']);
        $this->logMaster = new LogMaster();
        $this->logModel = new LoggingModel();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $master = MasterModel::paginate(5);
        $count_master = DB::table('masters')->count('nome');
        return view('master.master', compact(['master','count_master']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('master.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MasterRequest $request)
    {
        $validacoes = $request->validated();
        MasterModel::create($validacoes);
        $this->logModel->create([
            'descricao_log' => $this->logMaster->logCreateMaster(),
            'relacao' => "Master {$validacoes['nome']} agora está presente no sistema.",
        ]);
        return redirect('master')->with('success-store',"{$validacoes['nome']} está presente no sistema.");
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
        $master = MasterModel::find($id);
        return view('master.update', compact('master'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MasterRequest $request, $id)
    {
        $validacoes = $request->validated();
        MasterModel::where('id',$id)->update($validacoes);
        $this->logModel->create([
            'descricao_log' => $this->logMaster->logUpdateMaster(),
            'relacao' => "Master {$validacoes['nome']} obteve atualizações em suas informações.",
        ]);
        return redirect('master')->with('success-update',"{$validacoes['nome']} obteve atualizações em suas informações.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $nome = DB::table('masters')->where('id','=',$id)->value('nome');
        $this->logModel->create([
            'descricao_log' => $this->logMaster->logDeleteMaster(),
            'relacao' => "Master $nome não está mais presente no sistema.",
        ]);
        MasterModel::where('id',$id)->delete();
        return redirect('master')->with('success-destroy',"$nome não está mais presente no sistema.");
    }
}
