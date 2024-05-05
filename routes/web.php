<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;
use App\Http\Controllers\DesignFileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('files/{file}', [FileController::class, 'download'])->withoutMiddleware('')->name('files.download');
Route::get('design_files/{designFile}', [DesignFileController::class, 'download'])->withoutMiddleware('')->name('design_files.download');
