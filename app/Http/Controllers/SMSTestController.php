<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Helpers\SMSActivate;

class SMSTestController extends Controller
{
    public function smsactive()
    {
        $sms = new SMSActivate("8cbd0f4Ab1761f58bcc6f2df8bb3c1fA");
        return $sms->getCountries();
    }
}
