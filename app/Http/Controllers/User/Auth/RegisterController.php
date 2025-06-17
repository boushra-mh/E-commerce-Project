<?php

namespace App\Http\Controllers\User\Auth;

use App\Events\UserRegistered;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Auth\RegisterRequest;
use App\Models\User;
use App\Traits\ResponceTrait;


class RegisterController extends Controller
{use ResponceTrait;
    public function register(RegisterRequest $request)
    {
        $user=User::create($request->validated());

        // by helper function
        event(new UserRegistered($user));
         $token=$user->createToken('user_token')->plainTextToken;
         return $this->sendResponce(['access-token'=>$token],'you are register successfully');


    }
}
