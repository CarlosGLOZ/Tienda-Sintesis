<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
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

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Auth
Route::get('/auth/signup', [AuthController::class, 'signup'])->name('auth.signup');
Route::post('/auth/signup', [AuthController::class, 'register']);
Route::get('/auth/signin', [AuthController::class, 'signin'])->name('auth.signin');
Route::post('/auth/signin', [AuthController::class, 'login']);
Route::get('/auth/signout', [AuthController::class, 'logout'])->name('auth.signout');

// Products
Route::post('/products/show', [ProductController::class, 'show'])->name('product.show');
Route::get('/products/{id}', [ProductController::class, 'find'])->name('product.find');

// Shopping cart
Route::get('/cart', [ProductController::class, 'cart'])->name('cart');