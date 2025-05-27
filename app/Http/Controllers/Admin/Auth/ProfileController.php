<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Admin\AdminRequest;
use App\Models\Admin;
use App\Traits\ResponceTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    use ResponceTrait;
    public function getProfile()
    {
         if (!auth('admin')->check()) {
        return response()->json(['message' => 'Not authenticated'], 401);
    }
        $admin=auth('admin')->user();


        return $this->sendResponce($admin,'this_is_your_profile',200);
    }

    public function updateProfile(AdminRequest $request)
    {
        $admin=auth('admin')->user();
         $admin->update([
            'name'=>$request->name,
            'email' => $request->email,
            'phone' =>$request->phone


        ]);
          if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }
        $admin->save();
        return $this->sendResponce($admin,'Profile_admin_updated_successfully',200);
    }
}
