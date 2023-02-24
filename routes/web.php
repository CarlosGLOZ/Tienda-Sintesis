<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ShoppingCartController;
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

//EMAIL
Route::get('/enviarEmail', [AuthController::class, 'enviarEmail'])->name('enviarEmail');
Route::post('/FuncionMail',[AuthController::class,'FuncionMail'])->name('FuncionMail');
Route::post('/listarCorreos',[AuthController::class,'listarCorreos'])->name('listarCorreos');

//CRUD PRODCUTOS
Route::get('/crudProductos', [AuthController::class, 'crudProductos'])->name('crudProductos');
Route::post('/listar_crud_pro',[ProductController::class, 'listar_crud_pro'])->name('listar_crud_pro');
Route::delete('/eliminarProducto',[ProductController::class, 'eliminarProducto'])->name('eliminarProducto');
Route::post('/editarProducto',[ProductController::class, 'editarProducto'])->name('editarProducto');
Route::post('/crearProducto',[ProductController::class, 'crearProducto'])->name('crearProducto');

// Products
Route::get('/products/{id}', [ProductController::class, 'find'])->name('product.find');
<<<<<<< HEAD
Route::post('/products/show', [ProductController::class, 'show'])->name('product.show');

// Reviews
Route::post('/reviews/store/{product}', [ReviewController::class, 'store'])->name('review.store');
Route::delete('/reviews/destroy/{review}', [ReviewController::class, 'destroy'])->name('review.destroy');

// Cart
Route::get('/cart', [ShoppingCartController::class, 'show'])->name('cart.show');
Route::post('/cart/store/{product}', [ShoppingCartController::class, 'store'])->name('cart.store');
Route::delete('/cart/destroy/{product}', [ShoppingCartController::class, 'destroy'])->name('cart.destroy');
=======

>>>>>>> 184392a6dac01e273540b458a65f8feda5ed512a
