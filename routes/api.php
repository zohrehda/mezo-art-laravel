<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\PrintCartController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TicketMessageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DesignCotroller;
use App\Http\Controllers\DesignFileController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('auth')->group(function () {

    Route::post('/authenticate', [AuthController::class, 'authenticate'])->withoutMiddleware('auth:sanctum');
    Route::post('/verifyPassword', [AuthController::class, 'verifyPassword'])->withoutMiddleware('auth:sanctum');
    Route::post('/verifyOtp', [AuthController::class, 'verifyOtp'])->withoutMiddleware('auth:sanctum');
    Route::post('/sendOtp', [AuthController::class, 'sendOtp'])->withoutMiddleware('auth:sanctum');
    Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    Route::get('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');
    Route::put('/me', [AuthController::class, 'updateMe'])->middleware('auth:sanctum');
});

Route::get('designs/{design}/download', [DesignCotroller::class, 'downloadFiles']);
Route::apiResource('/designs', DesignCotroller::class);
Route::apiResource('/design_files', DesignFileController::class);

Route::apiResource('/users', UserController::class);
Route::apiResource('/categories', CategoryController::class);

Route::apiResource('/print_cart', PrintCartController::class);
Route::apiResource('/tickets', TicketController::class)->middleware('auth:sanctum');
Route::apiResource('/ticket_messages', TicketMessageController::class)->middleware('auth:sanctum');
Route::apiResource('/provinces', ProvinceController::class);
Route::apiResource('/cities', CityController::class);
Route::apiResource('/blogs', BlogController::class);
Route::apiResource('/tags', TagController::class);


