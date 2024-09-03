<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfessionController;
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

Route::post('admin/login', [UserController::class, 'apiAdminLogin']);

Route::post('user/login', [UserController::class, 'apiUserLogin']);
Route::post('user/registration', [UserController::class, 'apiUserRegistration']);

Route::middleware('auth:sanctum', 'ability:admin', 'throttle:1000,1')->group(function () {

    Route::group(['prefix' => 'profession'], function () {
        Route::get('/list', [ProfessionController::class, 'apiIndex']);
        Route::post('/create', [ProfessionController::class, 'apiCreate']);
        Route::get('/edit/{id}', [ProfessionController::class, 'apiEdit']);
        Route::post('/edit/{id}', [ProfessionController::class, 'apiUpdate']);
    });
});
Route::middleware('auth:sanctum', 'ability:user', 'throttle:1000,1')->group(function () {
});


Route::middleware('auth:sanctum', 'throttle:1000,1')->group(function () {
    Route::get('/user', [UserController::class, 'apiUserInfo']);

    Route::prefix('common')->group(function () {
        // Route::get('/{market}/index', [ShopController::class, 'apiIndex']);
    });
});
