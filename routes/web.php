<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ColorController as AdminColorController;
use App\Http\Controllers\Admin\SizeController as AdminSizeController;
use App\Http\Controllers\ProductController as ProductViewController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::prefix('admin')->name('admin.')->group(function() {
    Route::resource('products', AdminProductController::class);
    Route::resource('categories', AdminCategoryController::class);
    Route::resource('colors', AdminColorController::class);
    Route::resource('sizes', AdminSizeController::class);

});

Route::get('products', [ProductViewController::class, 'index'])->name('products.index');
Route::get('products/{product}', [ProductViewController::class, 'show'])->name('products.show');

// Route::get('/products', 'ProductController@index')->name('products.index');
// Route::get('/products/{product}', 'ProductController@show')->name('products.show');
