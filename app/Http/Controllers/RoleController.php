<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\RoleRequest;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::paginate(5);
        $count_roles = DB::table('roles')->count();
        return view('role.role', compact(['roles','count_roles']));
    }

    public function formCreateRole()
    {
        $permissions = Permission::orderBy('name')->get();
        return view('role.create', compact(['permissions']));
    }

    public function storeRole(RoleRequest $request)
    {
        $role = Role::create($request->validated());

        $permissions = $request->input('permissions', []);
        $permission_id = Permission::whereIn('name', $permissions)->pluck('id')->all();

        $role->permissions()->attach($permission_id);

        return redirect('role')->with('success-store',"O papel $request->name está presente no sistema.");
    }

    public function editRole($id)
    {
        $role = Role::find($id);
        $permissions = Permission::orderBy('name')->get();
        return view('role.update', compact(['role','permissions']));
    }

    public function updateRole(RoleRequest $request, $id)
    {
        $role = Role::find($id);

        $role->update($request->validated());

        $permissions = $request->input('permissions', []);
        $permission_id = Permission::whereIn('name', $permissions)->pluck('id')->all();

        $role->permissions()->sync($permission_id);

        return redirect('role')->with('success-update',"O papel $request->name recebeu modificação no sistema.");
    }

    public function destroyRole($id)
    {
        $nome = Role::where('id', '=', $id)->value('name');
        Role::where('id', $id)->delete();
        return redirect('role')->with('success-destroy',"O papel $nome não está mais presente no sistema.");
    }

    public function trashRole()
    {
        $roles = Role::onlyTrashed()->paginate(5);
        return view('role.trash-role', compact('roles'));
    }

    public function restoreRoleTrash($id)
    {
        $nome = Role::onlyTrashed()->find($id)->name;
        $role = Role::onlyTrashed()->find($id);
        $role->restore();
        return redirect('role')->with('success-store',"$nome retornou a listagem de Permissões.");
    }

    public function deleteRoleTrash($id)
    {
        $nome = Role::onlyTrashed()->find($id)->name;
        $role = Role::onlyTrashed()->find($id);
        $role->forceDelete();
        return redirect('role')->with('success-destroy',"$nome foi excluído(a) permanentemente do sistema.");
    }
}
