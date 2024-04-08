<?php

use Illuminate\Support\Facades\Route;

Route::middleware('api.gateway')->group(function () {
    Route::any('/user-service/auth/{any}')->where('any', '.*');
});
Route::middleware(['api.authCheck','api.gateway'])->group(function () {
    Route::any('/inventory-service/{any}')->where('any', '.*');
    Route::any('/account-service/{any}')->where('any', '.*');
    Route::any('/user-service/{any}')->where('any', '.*');
    Route::any('/gift-service/{any}')->where('any', '.*');
    Route::any('/report-service/{any}')->where('any', '.*');
    Route::any('/info-service/training/{any}')->where('any', '.*');
    Route::any('/info-service/admin/{any}')->where('any', '.*');
});

Route::middleware(['api.gateway'])->group(function () {
    Route::any('/info-service/{any}')->where('any', '.*');
    Route::any('/notification-service/otp/{any}')->where('any', '.*');

});
