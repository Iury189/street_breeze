<?php

namespace App\Http\Controllers;

use App\Events\FighterDeletedEvent;
use App\Loggings\LogFighter;
use App\Models\DojoModel;
use App\Models\FighterModel;
use App\Models\LoggingModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\FighterRequest;

class FighterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['index','create','store','edit','update','destroy']);
        $this->logFighter = new LogFighter();
        $this->logModel = new LoggingModel();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fighter = FighterModel::paginate(5);
        $count_fighter = DB::table('fighters')->count();
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
        $validacoes['passaporte'] = Str::upper($request->passaporte);
        FighterModel::create($validacoes);
        $this->logModel->create([
            'descricao_log' => $this->logFighter->logCreateFighter(),
            'relacao' => "Fighter {$validacoes['nome']} agora está presente no sistema.",
        ]);
        return redirect('fighter')->with('success-store',"{$validacoes['nome']} está presente no sistema.");
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
        $validacoes['passaporte'] = Str::upper($request->passaporte);
        FighterModel::where('id',$id)->update($validacoes);
        $this->logModel->create([
            'descricao_log' => $this->logFighter->logUpdateFighter(),
            'relacao' => "Fighter {$validacoes['nome']} obteve atualizações em suas informações.",
        ]);
        return redirect('fighter')->with('success-update',"{$validacoes['nome']} obteve atualizações em suas informações.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $nome = DB::table('fighters')->where('id','=',$id)->value('nome');
        $this->logModel->create([
            'descricao_log' => $this->logFighter->logDeleteFighter(),
            'relacao' => "Fighter $nome não está mais presente no sistema.",
        ]);
        $dojo = DojoModel::where('fighter_id',$id)->first();
        if ($dojo != null && $dojo->count() > 0) {
            Event::dispatch(new FighterDeletedEvent($id));
        }
        FighterModel::where('id',$id)->delete();
        return redirect('fighter')->with('success-destroy',"$nome não está mais presente no sistema.");
    }
}
