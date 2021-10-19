<?php

use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;

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

Route::post('/users', [UserController::class, 'create']);
Route::post('/login', [AuthenticationController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthenticationController::class, 'logout']);
    Route::get('/me', [AuthenticationController::class, 'me']);
});


Route::prefix('messages')->group(
    function () {
        Route::middleware('auth:sanctum')->group(
            function () {
                Route::get('/', [MessageController::class, 'index']);
                Route::get('/{message}', [MessageController::class, 'show']);
                Route::delete('/{message}', [MessageController::class, 'destroy']);
            }
        );

        Route::post('/', [MessageController::class, 'store']);
    }
);
