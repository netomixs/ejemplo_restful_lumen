<?php

namespace App\GenericClass;

class ResponseObject
{
    public $IsSuccess;
    public $Data;
    public $Message;
    public function toJson()
    {
        return json_encode($this);
    }
}
