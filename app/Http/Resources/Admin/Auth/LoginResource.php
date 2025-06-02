<?php

namespace App\Http\Resources\Admin\Auth;

use App\Enums\UserMediaEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
         return [
            'id'=>$this->id,
            'name'=>$this->name,
            'email'=>$this->email,
            'phone'=>$this->phone,
            'image'=>$this->getFirstMediaUrl(UserMediaEnum::MAIN_IMAGE->value) ,
            'access-token'=>$this->access_token
        ];
    }
}
