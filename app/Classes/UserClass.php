<?php

namespace App\Classes;
class UserClass
{
    public $first_name;
    public $last_name;
    public $status;
    public $age;
    public function __construct( $first_name,$last_name,$status,$age)
    {
        $this->first_name=$first_name;
        $this->last_name=$last_name;
        $this->status=$status;
        $this->age=$age;
    }

    public function isActive()
    {
        return $this->status=='active';
    }

}