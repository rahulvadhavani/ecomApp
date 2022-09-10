<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});



Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard',[CartController::class,'index'])->name('dashboard');
    Route::get('/cart',[CartController::class,'cart'])->name('cart');
    Route::post('/add-to-cart',[CartController::class,'addToCart'])->name('add_to_cart');
    Route::post('/remove-from-cart',[CartController::class,'removeFromCart'])->name('remove_from_cart');
    Route::post('/update-quantity',[CartController::class,'updateQuantity'])->name('update_quantity');
});

require __DIR__.'/auth.php';

Route::group(['middleware' => ['auth','admin'],'prefix' => 'admin'], function () {
    Route::get('/dashboard', function () {return view('dashboard');});
    Route::resource('product',ProductController::class,[
        'except' => [ 'update']
    ]);
});
