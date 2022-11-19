<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Loggings\LogUser;
use App\Models\LoggingModel;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth')->only(['viewAdmin','can:onlyAdmin']);
        $this->logUser = new LogUser();
        $this->loggingModel = new LoggingModel();
    }

    public function viewAdmin()
    {
        $user = User::paginate(5);
        Gate::authorize('onlyAdmin', $user); // $this->authorize('onlyAdmin', $user); // Using Policies
        return view('admin.admin', compact('user'));
    }
}