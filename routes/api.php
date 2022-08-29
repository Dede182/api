<?php

use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\photoApiController;
use App\Http\Controllers\productsApiController;
use App\Http\Controllers\reveApiContoller;
use App\Http\Controllers\ReveController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(function(){
    Route::post('/register',[ApiAuthController::class,'register'])->name('api.register');
    Route::post('/login',[ApiAuthController::class,'login'])->name('api.login');


    Route::middleware(['auth:sanctum'])->group(function(){
        Route::apiResource('products',productsApiController::class);
        Route::apiResource('reve',reveApiContoller::class);
        Route::get('/tokens',[ApiAuthController::class,'tokens'])->name('api.tokens');
        Route::post('/logout',[ApiAuthController::class,'logout'])->name('api.logout');
        Route::get('/logoutAll',[ApiAuthController::class,'logoutAll'])->name('api.logoutAll');
        Route::apiResource('photo',photoApiController::class);
    });

});


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
