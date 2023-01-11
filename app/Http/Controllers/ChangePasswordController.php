<?php

namespace App\Http\Controllers;

use App\Loggings\LogUser;
use App\Models\LoggingModel;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ChangeEmailRequest;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Support\Str;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['updatePassword','updateEmail']);
        $this->logUser = new LogUser();
        $this->logModel = new LoggingModel();
    }

    public function updatePassword(ChangePasswordRequest $request)
    {
        $user = Str::words(Auth::user()->name, 1, '');
        $validacoes = $request->validated();
        User::whereId(Auth::user()->id)->update(['password' => Hash::make($validacoes['new_password'])]);
        $this->logModel->create([
            'descricao_log' => $this->logUser->logUpdatePassword(),
            'relacao' => '',
        ]);
        return redirect('change_password')->with('success-update-password',"$user alterou sua senha com sucesso.");
    }

    public function updateEmail(ChangeEmailRequest $request)
    {
        $user = Str::words(Auth::user()->name, 1, '');
        $validacoes = $request->validated();
        User::whereId(Auth::user()->id)->update(['email' => $validacoes['new_email']]);
        $this->logModel->create([
            'descricao_log' => $this->logUser->logUpdateEmail(),
            'relacao' => '',
        ]);
        return redirect('change_email')->with('success-update-email',"$user alterou seu e-mail com sucesso.");
    }
}
