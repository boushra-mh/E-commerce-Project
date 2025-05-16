<?php

namespace App\Enums;

enum ProductStatus :string
{
    case Available='available';
    case OutOfStock = 'out_of_stock';
    case Archived = 'archived';

    public function label()
    {

       return match ($this) {
            self::Available => 'Available',
            self::OutOfStock => 'out_of_stock',
            self::Archived => 'Archived',
        };
    }

}
