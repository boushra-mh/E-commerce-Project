<?php

namespace App\Enums;

enum UserMediaEnum :string
{
      case  MAIN_IMAGE = 'profile-image' ;


    public static function disk(){
       return 'user';
    }

}
