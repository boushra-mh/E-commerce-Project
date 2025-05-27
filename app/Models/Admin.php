<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Model
{
    use HasFactory, Notifiable,HasApiTokens;
    protected $fillable=['name','email','password','phone'];

}
