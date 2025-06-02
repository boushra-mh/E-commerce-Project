<?php

namespace App\Enums;

enum ProductMediaEnum : string
{
    case  MAIN_IMAGE = 'main-image' ;

    case GALLERY = 'gallery';

    public function disk(){
        return match ($this){
            self::MAIN_IMAGE  => 'main_image' ,
            self::GALLERY => 'gallery'
        };
    }
}
