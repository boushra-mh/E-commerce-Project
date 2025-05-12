<?php

namespace App\Http\Controllers\API;

use App\Classes\UserClass;
use App\Http\Controllers\API\ApiController;

class UserController extends ApiController
{
    public function index()
    {
        $users =
            [
                new UserClass('Boushra', 'Almouhammad', 'active', 24),
                new UserClass('Samia', 'Almouhammad', 'inactive', 67),
                new UserClass('Nahla', 'Almouhammad', 'active', 33),
                new UserClass('Laila', 'Almouhammad', 'inactive', 65),
            ];

        // Option 1:
        // 1. Add full_name to each user
        // 2. Filter active users
        // 3. Remove duplicates

        $fullUsers = collect($users)->map(function ($user) {
            $user->full_Name = $user->first_name . ' ' . $user->last_name;
            return $user;
        })->filter(function ($q) {
            return $q->status == 'active';
        });
        return response()->json([
            'success' => true,
            'message' => 'Users retrieved successfully',
            'data' => $fullUsers
        ]);

        // Option 2: Using Higher Order Messages (HOM) to:
        // 1. Filter active users
        // 2. Reset keys with values()
        // 3. Map to get only first names

        // return collect($users)->filter->isActive()->map->first_name->values();
    }
}
