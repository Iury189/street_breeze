<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        // $this->authorize('onlyAdmin',$user); // Using Policies
        return view('admin.admin', compact('user'));
    }
}
