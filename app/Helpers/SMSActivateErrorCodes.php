<?php 

namespace App\Helpers;


use App\Helpers\SMSActivateRequestError;

class SMSActivateErrorCodes extends SMSActivateRequestError
{
    public function checkExist($errorCode)
    {
        return array_key_exists($errorCode, $this->errorCodes);
    }
}
