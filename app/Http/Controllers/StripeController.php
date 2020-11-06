<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Cashier\Cashier;

class StripeController extends Controller
{
    public function index(){
        $stripe = new \Stripe\StripeClient(getenv('STRIPE_SECRET'));
          $stripe->customers->create([
            'name' => 'Alfredo Alejandro',
            'email' => 'marencocode@gmail.com',
            'description' => 'Cliente registrado con mi aplicacion en laravel',
          ]);

          $stripe->charges->create([
            'amount' => 2000,
            'currency' => 'mxn',
            'source' => 'tok_mastercard',
            'description' => 'My First Test Charge (created for API docs)',
          ]);

          return $stripe->id;
    }
}
