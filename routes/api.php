<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PrintCartController;
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
    Route::get('/logout', [AuthController::class, 'logout']);
});

Route::get('designs/{design}/download', [DesignCotroller::class, 'downloadFiles']);
Route::apiResource('/designs', DesignCotroller::class);
Route::apiResource('/design_files', DesignFileController::class);

Route::apiResource('/users', UserController::class);
Route::apiResource('/categories', CategoryController::class)->withoutMiddleware('auth:sanctum');

Route::apiResource('/print_cart', PrintCartController::class)->withoutMiddleware('auth:sanctum');

