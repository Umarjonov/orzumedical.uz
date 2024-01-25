<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FirebasePushController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/test',[ProfileController::class,'test']);
Route::group(['middleware' => 'guest'], function () {
    Route::post('auth',[AuthController::class,'index']);
    Route::post('auth/login',[AuthController::class,'index'])->middleware('throttle:3,1');
});
Route::group([ 'middleware' => 'auth:sanctum', 'prefix' => 'push' ],function (){

    Route::post('setToken', [FirebasePushController::class, 'setToken'])->name('firebase.token');
    Route::post('send/notification',[FirebasePushController::class,'notification'])->name('firebase.send');

});
Route::group(['middleware'=>'auth:sanctum'],function (){
    Route::resource('users', 'App\Http\Controllers\Api\UserController');
    Route::post('profile',[App\Http\Controllers\Api\UserController::class,'profileUpdate']);
    Route::get('user_check',[App\Http\Controllers\Api\UserController::class,'user_check']);
});
