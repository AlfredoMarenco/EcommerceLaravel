<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Openpay;

class OpenpayController extends Controller
{
    public function charge()
    {
        $openpay = Openpay::getInstance('m4gx48zqyw8xs4en1z1u', 'sk_d70ffc17846544e39488869d11fac3dc', 'MX');

        $customer = array(
            'name' => 'Alfredo',
            'last_name' => 'Gonzalez Marenco',
            'phone_number' => '9991577470',
            'email' => 'alfredomarenco@boletea.com'
        );

        $chargeData = array(
            'method' => 'card',
            'source_id' => $_POST["token_id"],
            'amount' => 15000, // formato númerico con hasta dos dígitos decimales. 
            'description' => 'TCBC201012',
            'use_3d_secure' => true,
            'redirect_url' => 'http://ecommercelaravel.test/openpay/getTransaction',
            'device_session_id' => $_POST["deviceIdHiddenFieldName"],
            'customer' => $customer
        );

        $charge = $openpay->charges->create($chargeData);
        $url3Dsecure = $charge->payment_method->url;
        return redirect()->away($url3Dsecure);
    }


    public function getTransaction()
    {
        $id = $_GET['id'];
        $openpay = Openpay::getInstance('m4gx48zqyw8xs4en1z1u', 'sk_d70ffc17846544e39488869d11fac3dc', 'MX');
        $charge = $openpay->charges->get($id);
        $charge->status;

        if($charge->status === 'completed'){
            return "Orden completada";
        }else{
            return "Orden no Completada";
        }
        
    }
}
