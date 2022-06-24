<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SodasController;
use App\Http\Controllers\Api\UsersController;

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

Route::prefix('users')->name('users.')->group(function () {
    // get users
    Route::get('/', [UsersController::class, 'get'])->name('get');

    // store user
    Route::post('/', [UsersController::class, 'store'])->name('store');
});

Route::prefix('sodas')->name('sodas.')->group(function () {

    // get soda
    Route::get('/', [SodasController::class, 'get'])->name('get');

    // store soda
    Route::post('/', [SodasController::class, 'store'])->name('store');

    // update soda
    // {soda} is the id
    Route::patch('/{soda}', [SodasController::class, 'update'])->name('update');

    // delete soda
    // {soda} is the id
    Route::delete('/{soda}', [SodasController::class, 'delete'])->name('delete');
});
