<?php

use App\Http\Controllers\ProductCategoryController;

use App\Http\Controllers\ProductStockController;

use App\Http\Controllers\UnitController;
use App\Http\Controllers\UnitConversionController;

use Illuminate\Support\Facades\Route;



Route::middleware('api.gateway')->group(function () {
    Route::any('/user/auth/{any}')->where('any', '.*');
});
Route::middleware(['api.authCheck','api.gateway'])->group(function () {
    Route::any('/inventory/{any}')->where('any', '.*');
    Route::any('/account/{any}')->where('any', '.*');
    Route::any('/user/{any}')->where('any', '.*');
    Route::any('/point/{any}')->where('any', '.*');
});


