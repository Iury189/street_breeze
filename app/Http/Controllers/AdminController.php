<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Loggings\LogAdmin;
use App\Models\LoggingModel;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth')->only(['viewAdmin','can:onlyAdmin']);
        $this->logAdmin = new LogAdmin();
        $this->loggingModel = new LoggingModel();
    }

    public function viewAdmin()
    {
        $user = User::paginate(5);
        Gate::authorize('onlyAdmin', $user); // $this->authorize('onlyAdmin', $user); // Using Policies
        $this->loggingModel->create([
            'descricao' => $this->logAdmin->logAdminPage(), 
            'metodo_operacao' => 'viewAdmin',
        ]);
        return view('admin.admin', compact('user'));
    }
}