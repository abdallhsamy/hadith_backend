<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Request;

class UserController extends Controller
{
    public function index(Request $request, $offset = 0, $limit = 10)
    {
        $users = User::query()
            ->select(
                '_id',
                'name',
//                'email',
//                'phone',
                'role',
                'status',
//                'gender',
//                'avatar',
            )
            ->paginate()
            ->withQueryString();


        return view('dashboard.users.index', compact('users'));
    }

    public function create()
    {

    }
}
