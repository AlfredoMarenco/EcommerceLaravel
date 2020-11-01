<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OpenpayController extends Controller
{
    public function charge(Request $request){
        $openpay = Openpay::getInstance(env('MERCHANT_ID'), env('PRIVATE_KEY'), env('COUNTRY_CODE'));
    }
}
