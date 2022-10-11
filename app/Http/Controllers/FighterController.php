<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\FighterRequest;
use App\Models\FighterModel;

class FighterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fighter = FighterModel::paginate(5);
        $count_fighter = DB::table('fighter')->count();
        return view('fighter.fighter', compact(['fighter','count_fighter']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fighter.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FighterRequest $request)
    {
        $validacoes = $request->validated();
        FighterModel::create($validacoes);
        return redirect('fighter')->with('success-store','Fighter está presente no sistema.');  
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
        $fighter = FighterModel::find($id);
        return view('fighter.update', compact('fighter'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FighterRequest $request, $id)
    {
        $validacoes = $request->validated();
        FighterModel::where('id',$id)->update($validacoes);
        return redirect('fighter')->with('success-update','Fighter obteve atualizações em suas informações.');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        FighterModel::where('id',$id)->delete();
        return redirect('fighter')->with('success-destroy','Fighter não está mais presente no sistema.');    
    }
}