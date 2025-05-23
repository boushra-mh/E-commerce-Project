<?php

namespace App\Enums;

enum TypeDiscountEnums:string
{

    case FIXED ='fixed';
    case PERCENTAGE='percentage';

    public function label()
    {
        return match($this)
        {
            self::FIXED=>'fixed',
            self::PERCENTAGE=>'PERCENTAGE',
        };
    }

}
