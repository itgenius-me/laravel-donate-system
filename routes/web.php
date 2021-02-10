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
    Route::get('home', [HomeController::class, 'index'])->name('home');

    Route::group(['middleware' => 'role:Admin', 'prefix' => 'admin', 'as'=>'admin.'], function () {
        Route::resource('/users', UserController::class);
        Route::post('/users/update-status', [UserController::class, 'postUpdateStatus']);
        Route::get('referal-teams', [App\Http\Controllers\Admin\ReferalTeamController::class, 'getIndex']);

        Route::get('get-help', [App\Http\Controllers\Admin\GHelpController::class, 'index']);
        Route::get('get-help/create', [App\Http\Controllers\Admin\GHelpController::class, 'create']);
        Route::post('get-help/store', [App\Http\Controllers\Admin\GHelpController::class, 'store']);
        Route::get('get-help/edit/{id}', [App\Http\Controllers\Admin\GHelpController::class, 'edit'])->name('get-help.edit');
        Route::post('get-help/update/{id}', [App\Http\Controllers\Admin\GHelpController::class, 'update'])->name('get-help.update');
        Route::delete('get-help/destroy/{id}', [App\Http\Controllers\Admin\GHelpController::class, 'destroy'])->name('get-help.destroy');

        Route::get('provide-help', [App\Http\Controllers\Admin\PHelpController::class, 'index']);
        Route::get('provide-help/create', [App\Http\Controllers\Admin\PHelpController::class, 'create']);
        Route::post('provide-help/store', [App\Http\Controllers\Admin\PHelpController::class, 'store']);
        Route::get('provide-help/edit/{id}', [App\Http\Controllers\Admin\PHelpController::class, 'edit'])->name('provide-help.edit');
        Route::post('provide-help/update/{id}', [App\Http\Controllers\Admin\PHelpController::class, 'update'])->name('provide-help.update');
        Route::delete('provide-help/destroy/{id}', [App\Http\Controllers\Admin\PHelpController::class, 'destroy'])->name('provide-help.destroy');
    });

    Route::get('test', function () {
        $ip = request()->ip();
        dd($ip);
    });
});
