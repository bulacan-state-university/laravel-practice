<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\UserRequest;
use App\Http\Resources\User\UserResource;

class UsersController extends Controller
{
    public function get()
    {
        // get list of users in users table
        $list = User::orderBy('id')->get();

        // return list of data using UserResource format
        return UserResource::collection($list);
    }

    public function store(UserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return [
            'created' => $user->save()
        ];
    }
}
