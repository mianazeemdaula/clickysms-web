<?php

namespace App\Helpers;

use Exception;

class ApiResponses
{
    static public function balance($value)
    {
        return ['balance' => $value];
    }

    static public function order($id, $number, $seconds)
    {
        return ['id' => $id, 'mobile' => $number, 'seconds' => $seconds];
    }

    static public function error($value)
    {
        return new Exception($value);
    }
}
