<?php

namespace App\Enums;

enum StatusEnums :string
{

    case ACTIVE="active";
    case INACTIVE="inactive";

    public function translate($this)
    {
        return match
    }

}
