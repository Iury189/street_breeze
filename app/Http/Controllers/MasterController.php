<?php

namespace App\Http\Controllers;

use App\Loggings\LogMaster;
use App\Models\MasterModel;
use App\Models\LoggingModel;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\MasterRequest;
use Illuminate\Http\Request;

class MasterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['index','create','store','edit','update','destroy']);
        $this->logMaster = new LogMaster();
        $this->loggingModel = new LoggingModel();
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
        $this->loggingModel->create([
            'descricao_log' => $this->logMaster->logCreateMaster(), 
            'metodo_operacao' => 'store',
            'relacao' => "Master {$validacoes['nome']} agora está presente no sistema.",
        ]);
        return redirect('master')->with('success-store','Master está presente no sistema.');  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
        $id_master = DB::table('masters')->where('id','=',$id)->value('id');
        $this->loggingModel->create([
            'descricao_log' => $this->logMaster->logUpdateMaster(), 
            'metodo_operacao' => 'update',
            'relacao' => "Master ID $id_master obteve atualizações em suas informações.",
        ]);
        return redirect('master')->with('success-update','Master obteve atualizações em suas informações.');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id_master = DB::table('masters')->where('id','=',$id)->value('id');
        $this->loggingModel->create([
            'descricao_log' => $this->logMaster->logDeleteMaster(), 
            'metodo_operacao' => 'destroy',
            'relacao' => "Master ID $id_master foi excluído(a) do sistema.",
        ]);
        MasterModel::where('id',$id)->delete();
        return redirect('master')->with('success-destroy','Master não está mais presente no sistema.');    
    }
}