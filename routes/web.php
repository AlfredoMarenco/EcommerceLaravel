<?php

use App\Http\Controllers\ConektaController;
use App\Http\Controllers\OpenpayController;
use App\Http\Controllers\SocialLiteController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\WebhookController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Monolog\Handler\SlackWebhookHandler;

Route::get('/', function () {
    return view('index');
});

//Rutas Login providers externos
Route::get('login/{provider}', [SocialLiteController::class, 'redirectToProvider']);
Route::get('login/{provider}/callback', [SocialLiteController::class, 'handleProviderCallback']);

// Route::get('login/facebook', [SocialLiteController::class, 'redirectToProviderFacebook'])->name('login.facebook');
// Route::get('login/facebook/callback', [SocialLiteController::class, 'handleProviderCallbackFacebook']);

// Route::get('login/google', [SocialLiteController::class, 'redirectToProviderFacebook'])->name('login.facebook');
// Route::get('login/google/callback', [SocialLiteController::class, 'handleProviderCallbackFacebook']);

//Rutas Openpay
Route::any('openpay/charge', [OpenpayController::class ,'charge'])->name('card-charge');
Route::get('openpay/getTransaction/', [OpenpayController::class,'getTransaction']);
Route::any('openpay/webhook', [WebhookController::class ,'webhook']);
Route::any('openpay/getwebhook', [WebhookController::class ,'getwebhook']);

//Rutas Procesador de pagos Conekta
Route::any('conekta/charge', [ConektaController::class ,'charge']);
Route::any('conekta/webhook', [WebhookController::class ,'webhook']);
Route::any('conekta/webhook', [SlackWebhookHandler::class ,'webhook']);

//Rutas Procesador de pago Stripe
Route::any('stripe/webhook', [StripeController::class ,'index']);

// Rutas de Jestream
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware(['auth'])->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('status', 'verification-link-sent');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
