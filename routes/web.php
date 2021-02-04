<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['verify' => true]);

Route::middleware(['auth', 'verified', 'activated'])->group( function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::group(['middleware' => 'role:Admin', 'prefix' => 'admin', 'as'=>'admin.'], function () {
        Route::resource('/users', UserController::class);
        Route::post('/users/update-status', [UserController::class, 'postUpdateStatus']);
    });

    Route::get('test', function () {
        $ip = request()->ip();
        dd($ip);
    });
});