<?php

namespace App\Models;

use App\Enums\StatusEnum;
use App\Enums\UserMediaEnum;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable implements HasMedia
{
    use HasFactory, Notifiable,HasApiTokens ,InteractsWithMedia ,HasRoles;
    protected $fillable=['name','email','status','password','phone'];
    protected $casts=['status'=>StatusEnum::class,
    'password ' => 'hashed'];
      public function registerMediaCollections(): void
    {
        $this->addMediaCollection(UserMediaEnum::MAIN_IMAGE->value)
            ->useDisk(UserMediaEnum::MAIN_IMAGE->disk())
            ->singleFile();

    }

}
