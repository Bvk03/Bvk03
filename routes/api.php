<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=>'auth'], function(){
    Route::post('Login',[AuthController::class,'Login']);
    Route::post('register',[AuthController::class,'register']);
   
    Route::group(['middleware' => 'auth:sanctum'], function(){
        Route::get('Logout',[AuthController::class,'Logout']);
        Route::get('user',[AuthController::class,'user']);
        Route::get('index',[EmployeeController::class,'index']);
        Route::post('store',[EmployeeController::class,'store']);
        Route::post('edit/{id}',[EmployeeController::class,'show']);
        Route::post('delete/{id}',[EmployeeController::class,'delete']);
        Route::get('search/{EmployeeName}',[EmployeeController::class,'search']);
    });
});