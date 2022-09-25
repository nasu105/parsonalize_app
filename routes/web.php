<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\ItemController;
use App\Http\Controllers\User\StarController;

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
Route::group(['middleware' => 'auth:users'], function() {
    // Route::get('/item/buyCheck', [ItemController::class, 'buyCheck'])->name('item.buyCheck');
    Route::resource('star', StarController::class);
    // Route::post('item/{item}/stars', [StarController::class, 'store'])->name('stars');
    // Route::put('item/{item}/againstars', [StarController::class, 'update'])->name('againstars');
    Route::resource('item', ItemController::class);
});


Route::get('/', function () {
    return view('user.welcome');
});

Route::get('/dashboard', function () {
    return view('user.dashboard');
})->middleware(['auth:users'])->name('dashboard');

require __DIR__.'/auth.php';
