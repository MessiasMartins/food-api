<?php

namespace App\Http\Controllers;

use App\Http\Resources\User\UserResourceCollection;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function __construct()
    {
//        if (!Gate::allows('is-admin')) {
//            abort(403);
//        }
        Gate::authorize('is-admin');
    }

    public function index()
    {
        return new UserResourceCollection(User::where('profile', '!=', User::USER_ADMINISTRADOR)->get());
    }
}
