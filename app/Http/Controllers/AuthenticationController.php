<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Http\Resources\UserRegisterResource;
use App\Models\User;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    public function register(RegisterUserRequest $request)
    {
        $user = User::create($request->payload());

        return UserRegisterResource::make($user);
    }
}
