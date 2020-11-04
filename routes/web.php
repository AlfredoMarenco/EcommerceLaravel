<?php

use App\Http\Controllers\ConektaController;
use App\Http\Controllers\OpenpayController;
use App\Http\Controllers\WebhookController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Monolog\Handler\SlackWebhookHandler;

Route::get('/', function () {
    return view('welcome');
});

Route::any('openpay/charge', [OpenpayController::class ,'charge'])->name('card-charge');
Route::any('conekta/charge', [ConektaController::class ,'charge']);
Route::any('/openpay/webhook', [WebhookController::class ,'webhook']);
Route::any('/openpay/getwebhook', [WebhookController::class ,'getwebhook']);
Route::any('/conekta/webhook', [WebhookController::class ,'webhook']);
Route::any('/conekta/webhook', [SlackWebhookHandler::class ,'webhook']);

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
