<?php

namespace App\Http\Controllers;

use Conekta\Conekta;
use Conekta\Order;
use Illuminate\Http\Request;


class ConektaController extends Controller
{
    public function charge()
    {
        Conekta::setApiKey('key_Jdv7yUAVsAT6pfPKSxLqFA');

        \Conekta\Order::create([
            'currency' => 'MXN',
            'customer_info' => [
              'customer_id' => 'cus_2ofagiYYcSpmtu2ds',
              'antifraud_info' => [
                'paid_transactions' => 4
              ]
              ],
            'line_items' => [
              [
                'name' => 'Box of Cohiba S1s',
                'unit_price' => 35000,
                'quantity' => 1,
                'antifraud_info' => [
                    'trip_id'        => '12345',
                    'driver_id'      => 'driv_1231',
                    'ticket_class'   => 'economic',
                    'pickup_latlon'  => '23.4323456,-123.1234567',
                    'dropoff_latlon' => '23.4323456,-123.1234567'
                ]
              ]
            ],
            'charges' => [
              [
                'payment_method' => [
                  'type' => 'default'
                ]
              ]
            ]
          ]);
    }
}
