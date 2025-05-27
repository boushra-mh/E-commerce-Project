<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Admin\AdminRequest;
use App\Http\Resources\Admin\AdminResource;
use App\Models\Admin;
use App\Traits\ResponceTrait;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{


    use ResponceTrait;
    public function login(AdminRequest $request)
    {
       $data = $request->validated();

        $admin = Admin::where('email',$data['email'])->first();

        if(!$admin || !Hash::check($data['password'] ,$admin->password )){
            return $this->sendError('Invalid credentials');
        }

       $admin->access_token = $admin->createToken('admin_token')->plainTextToken ;

        return $this->sendResponce(AdminResource::make($admin),'User Logged in successfully');

    }

    public function logout()
    {
        $user=auth('admin')->user();
            //        return $user->tokens()->get();

        // delete all tokens
//        $user->tokens()->delete() ;

        // remove received token
        $user->currentAccessToken()->delete();

        return $this->sendResponce(null ,'user logout successfully');

    }
}
