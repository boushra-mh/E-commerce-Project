<?php

namespace App\Enums;

enum StatusEnum:string
{
case Active='active';
case InActive='inactive';



public function label()
    {

       return match ($this) {

            self::Active => __('active'),
            self::InActive => __('inactive'),


        };

    }

}
