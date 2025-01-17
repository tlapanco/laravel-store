<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\ProductController;
use App\Http\Controllers\Web\ProductImageController;
use App\Http\Controllers\Web\CategoryController;
use Illuminate\Support\Facades\Route;

use App\Models\Product;
//Products Routes
Route::middleware(['auth'])->group(function () {
    Route::resource('productos', ProductController::class)->only(['index']);
    Route::resource('producto', ProductController::class)->except([
        'index'
    ]);
    
});

//Product images routes
Route::middleware(['auth'])->group(function () {
	Route::any('borrar-imagen-producto/{id}', [ProductImageController::class, 'destroy'])->name('product.image.destroy');
});


//Categories routes
Route::middleware(['auth'])->group( function ( ) {
    Route::resource('categorias', CategoryController::class)->only(['index']);
    Route::resource('categoria', CategoryController::class)->except(['show', 'index']);
});


Route::get('/', function(){
    dd(Product::all()[0]->category->name);
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
