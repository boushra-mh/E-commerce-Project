<?php

namespace App\Enums;

enum ColorsStatus:string
{
case Active='active';
case InActive='inactive';

case مفعل= 'مفعل';

case غيرمفعل = 'غير مفعل';

public function label()
    {

       return match ($this) {
           
            self::Active => 'active',
            self::InActive => 'inactive',
            
            self::مفعل => 'مفعل',
            self::غيرمفعل => 'غير مفعل' ,
        };
        
    }

}
