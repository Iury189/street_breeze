<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $user = User::paginate(5);
        $count_users = DB::table('users')->count();
        return view('user.user', compact(['user','count_users']));
    }

    public function formCreateUser()
    {
        //$roles = Role::whereNotIn('name', ['Admin'])->get();
        $roles = Role::orderBy('name')->get();
        return view('user.create', compact(['roles']));
    }

    public function storeUser(UserRequest $request)
    {
        $validacoes = $request->validated();

        $user = User::create([
            'name' => $validacoes['name'],
            'email' => $validacoes['email'],
            'password' => Hash::make($validacoes['password']),
        ]);

        $roles = Role::whereIn('name', $validacoes['roles'])->pluck('id')->toArray();

        $user->roles()->attach($roles);

        return redirect('user')->with('success-store',"$request->name está presente no sistema.");
    }

    public function editUser($id)
    {
        $user = User::find($id);
        //$roles = Role::whereNotIn('name', ['Admin'])->get();
        $roles = Role::orderBy('name')->get();
        return view('user.update', compact(['user','roles']));
    }

    public function updateUser(UserRequest $request, $id)
    {
        $user = User::find($id);

        $roles_names = $request->input('roles', []);
        $roles_id = Role::whereIn('name', $roles_names)->pluck('id');

        $user->roles()->sync($roles_id);

        return redirect('user')->with('success-update',"$request->name recebeu modificação no sistema.");
    }

    public function destroyUser($id)
    {
        $nome = User::where('id', '=', $id)->value('name');
        User::where('id', $id)->delete();
        return redirect('user')->with('success-destroy',"$nome não está mais presente no sistema.");
    }

    public function trashUser()
    {
        $users = User::onlyTrashed()->paginate(5);
        return view('user.trash-user', compact('users'));
    }

    public function restoreUserTrash($id)
    {
        $nome = User::onlyTrashed()->find($id)->name;
        $user = User::onlyTrashed()->find($id);
        $user->restore();
        return redirect('user')->with('success-store',"$nome retornou a listagem de usuários.");
    }

    public function deleteUserTrash($id)
    {
        $nome = User::onlyTrashed()->find($id)->name;
        $user = User::onlyTrashed()->find($id);
        $user->forceDelete();
        return redirect('user')->with('success-destroy',"$nome foi excluído(a) permanentemente do sistema.");
    }
}
