<?php

namespace App\Enums\Enums\Media;

enum ColorMediaEnum : string
{
    case  MAIN_IMAGE = 'main-image' ;


    public static function disk(){
       return 'color';
    }
}
