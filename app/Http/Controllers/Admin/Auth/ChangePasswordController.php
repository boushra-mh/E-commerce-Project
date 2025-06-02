<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Admin\ChangePasswordRequest;
use App\Traits\ResponceTrait;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    use ResponceTrait;
    public function changePassword(ChangePasswordRequest $request)
    {
          if(( $request->new_password!=$request->confirmed_password))
        {

            return $this->sendError('password_incorrect','422');

        }

        $admin = auth('admin')->user();



        if(!Hash::check($request->current_password,$admin->password))
        {

            return $this->sendError('password_incorrect','422');

        }
           $admin->password = Hash::make($request->new_password);
        $admin->save();

        return $this->sendResponce(null,'password_updated_successfully');

    }
}
