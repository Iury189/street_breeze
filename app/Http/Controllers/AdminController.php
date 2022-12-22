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
    }

    public function viewAdmin()
    {
        $user = User::paginate(5);
        Gate::authorize('onlyAdmin', $user);
        return view('admin.admin', compact('user'));
    }

}
