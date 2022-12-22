<?php

namespace App\Http\Controllers;

use App\Loggings\LogUser;
use App\Models\LoggingModel;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ChangePasswordRequest;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['updatePassword']);
        $this->logUser = new LogUser();
        $this->logModel = new LoggingModel();
    }

    public function updatePassword(ChangePasswordRequest $request)
    {
        $user = Auth::user()->name;
        $validacoes = $request->validated();
        User::whereId(Auth::user()->id)->update(['password'=> Hash::make($validacoes['new_password'])]);
        $this->logModel->create([
            'descricao_log' => $this->logUser->logUpdatePassword(),
            'relacao' => '',
        ]);
        return redirect('change_password')->with('success-update-password',"$user alterou sua senha com sucesso.");
    }
}
