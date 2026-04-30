<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TransactionController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/packages', [HomeController::class, 'packages'])->name('packages.index');
Route::get('/packages/{package}', [HomeController::class, 'showPackage'])->name('packages.show');

// Cart Routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{package}', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout')->middleware('auth');
Route::post('/checkout/process', [CartController::class, 'processCheckout'])->name('cart.checkout.process')->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/transactions', [TransactionController::class, 'userIndex'])->name('transactions.index');
    Route::get('/transactions/create/{package}', [TransactionController::class, 'create'])->name('transactions.create');
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::middleware(['auth', 'can:admin'])->prefix('admin')->group(function () {
    Route::resource('packages', PackageController::class, ['as' => 'admin']);
    Route::get('/transactions', [TransactionController::class, 'index'])->name('admin.transactions.index');
});

require __DIR__.'/auth.php';
