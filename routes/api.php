<?php

use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductStockController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UnitConversionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('role:admin')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' =>['role:admin', 'userInfo']], function(){
    Route::get('/test', function (Request $request) {
        return ' $request->user()';
    });
});
Route::post('/file', [ProductController::class, 'fileUpload']);



/*Route::get('/admin', function () {
    Route::post('product', [ProductController::class, 'store']);

    // Only users with the 'admin' role can access this route
})->middleware('role:admin');*/



//This are the finalize route


Route::group(['middleware' => ['role:admin', 'userInfo']], function(){
    Route::group(['prefix' => 'v1'], function(){
        Route::group(['prefix' => 'transactions'], function(){
            Route::get('/', [TransactionController::class, 'list']);
        });
    });


});
