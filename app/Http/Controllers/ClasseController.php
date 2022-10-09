<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ClasseRequest;
use App\Models\ClasseModel;
use App\Models\FighterModel;
use App\Models\MasterModel;

class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classe = ClasseModel::paginate(5);
        $count_classe = DB::table('classe')->distinct()->count('id');
        return view('classe.classe', compact(['classe','count_classe']));
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
        return view('classe.create', compact(['fighter','master']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClasseRequest $request)
    {
        $validacoes = $request->validated();
        ClasseModel::create($validacoes);
        return redirect('classe')->with('success-store','Classe está presente no sistema.');  
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
        $classe = ClasseModel::find($id);
        $fighter = FighterModel::get(['id','nome']);
        $master = MasterModel::get(['id','nome']);
        return view('classe.update', compact(['classe','fighter','master']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClasseRequest $request, $id)
    {
        $validacoes = $request->validated();
        ClasseModel::where('id',$id)->update($validacoes);
        return redirect('classe')->with('success-update','Classe obteve atualizações em suas informações.');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ClasseModel::where('id',$id)->delete();
        return redirect('classe')->with('success-destroy','Classe não está mais presente no sistema.');    
    }
}