<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('/categories')->controller(CategoryController::class)->group(function () {
        Route::get('/', 'index')->name('categories.index');
        Route::get('/create', 'create')->name('categories.create');
        Route::post('/create', 'store')->name('categories.store');
        Route::post('/delete', 'delete')->name('categories.delete');
    });

    Route::prefix('/products')->controller(ProductController::class)->group(function () {
        Route::get('/', 'index')->name('products.index');

        Route::get('/create', 'create')->name('products.create');
        Route::post('/store', 'store')->name('products.store');

        Route::prefix('/{product}')->group(function () {
            Route::get('/edit', 'edit')->name('products.edit');
            Route::post('/update', 'update')->name('products.update');

            Route::post('/delete', 'delete')->name('products.delete');
        });
    });

    Route::prefix('/orders')->controller(OrderController::class)->group(function () {
        Route::get('/', 'index')->name('orders.index');

        Route::get('/create', 'create')->name('orders.create');
        Route::post('/store', 'store')->name('orders.store');

        Route::prefix('/{order}')->group(function () {
            Route::get('/edit', 'edit')->name('orders.edit');
            Route::post('/update', 'update')->name('orders.update');

            Route::post('/delete', 'delete')->name('orders.delete');
        });
    });
});

require __DIR__.'/auth.php';
