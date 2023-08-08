<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionRequest;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::paginate(5);
        $count_permissions = DB::table('permissions')->count();
        return view('permission.permission', compact(['permissions','count_permissions']));
    }

    public function formCreatePermission()
    {
        return view('permission.create');
    }

    public function storePermission(PermissionRequest $request)
    {
        Permission::create(array_map('trim', $request->validated()));
        return redirect('permission')->with('success-store',"A permissão $request->name está presente no sistema.");
    }

    public function editPermission($id)
    {
        $permission = Permission::find($id);
        return view('permission.update', compact('permission'));
    }

    public function updatePermission(PermissionRequest $request, $id)
    {
        Permission::where('id', $id)->update(array_map('trim', $request->validated()));
        return redirect('permission')->with('success-update',"A permissão $request->name recebeu modificação no sistema.");
    }

    public function destroyPermission($id)
    {
        $nome = Permission::where('id', '=', $id)->value('name');
        Permission::where('id', $id)->delete();
        return redirect('permission')->with('success-destroy',"A permissão $nome não está mais presente no sistema.");
    }

    public function trashPermission()
    {
        $permissions = Permission::onlyTrashed()->paginate(5);
        return view('permission.trash-permission', compact('permissions'));
    }

    public function restorePermissionTrash($id)
    {
        $nome = Permission::onlyTrashed()->find($id)->name;
        $permission = Permission::onlyTrashed()->find($id);
        $permission->restore();
        return redirect('trash-permission')->with('success-store',"$nome retornou a listagem de Permissões.");
    }

    public function deletePermissionTrash($id)
    {
        $nome = Permission::onlyTrashed()->find($id)->name;
        $permission = Permission::onlyTrashed()->find($id);
        $permission->forceDelete();
        return redirect('trash-permission')->with('success-destroy',"$nome foi excluído(a) permanentemente do sistema.");
    }

}
