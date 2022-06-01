<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\DashboardController;

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
    return redirect('/login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [CartController::class, 'shop'])->name('dashboard');
    Route::get('/cart', [CartController::class, 'cart'])->name('cart.index');
    Route::post('/add', [CartController::class, 'add'])->name('cart.store');
    Route::post('/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::get('/store', [CartController::class, 'store'])->name('cart.checkout');
    Route::get('/pdf/{in}', [InvoiceController::class, 'genPDF']);
});

Route::prefix('/products')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('admin');
        Route::get('/create', [DashboardController::class, 'create'])->name('product.create');
        Route::post('/store', [DashboardController::class, 'store'])->name('product.store');
        Route::get('/edit/{id}', [DashboardController::class, 'edit'])->name('product.edit');
        Route::post('/update/{id}', [DashboardController::class, 'update'])->name('product.update');
        Route::post('/delete/{id}', [DashboardController::class, 'destroy'])->name('product.destroy');
    });

Route::prefix('/category')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('category');
        Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::post('/update/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::post('/delete/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    });
