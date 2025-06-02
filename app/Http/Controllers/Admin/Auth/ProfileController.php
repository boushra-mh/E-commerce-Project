<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Admin\AdminRequest;
use App\Http\Resources\Admin\AdminResource;
use App\Http\Resources\Admin\Auth\LoginResource;
use App\Traits\ResponceTrait;


class ProfileController extends Controller
{
    use ResponceTrait;

    public function getProfile()
    {
        if (!auth('admin')->check()) {
            return response()->json(['message' => 'Not authenticated'], 401);
        }
        $admin = auth('admin')->user();

        return $this->sendResponce($admin, 'this_is_your_profile', 200);
    }

    public function updateProfile(AdminRequest $request)
    {
        $admin = auth('admin')->user();
        $admin->update($request->validated());

        if ($request->has('image')) {
            $admin
                ->addMedia($request->file('image'))
                ->toMediaCollection('profile-image');
        }
        $admin->save();
        return $this->sendResponce(new LoginResource($admin), 'Profile_admin_updated_successfully', 200);
    }
}
