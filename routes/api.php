<?php

use App\Http\Controllers\Api\FileApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('files', [FileApiController::class, 'get'])->name('api.file.get');
    Route::post('files', [FileApiController::class, 'create'])->name('api.file.create');
    Route::delete('files/{file}', [FileApiController::class, 'destroy'])->name('api.file.destroy');
});
