<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\DojoRequest;
use App\Models\DojoModel;
use App\Models\FighterModel;
use App\Models\MasterModel;

class DojoController extends Controller
{
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
        DojoModel::where('id',$id)->delete();
        return redirect('dojo')->with('success-destroy','Dojo não está mais presente no sistema.');
    }
}
