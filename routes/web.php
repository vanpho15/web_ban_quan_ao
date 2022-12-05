<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CartController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\HomeController;

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

Route::get('/admin/users/login',[LoginController::class, 'index'])->name('login');
Route::post('/admin/users/store',[LoginController::class, 'store'])->name('admin.store');
Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/',[MainController::class, 'index'])->name('admin.index');
        Route::get('/main',[MainController::class, 'index']);
        #menu
        Route::prefix('/menus')->group(function () {
            Route::get('/add',[MenuController::class, 'create'])->name('menus.create');
            Route::post('/add/store',[MenuController::class, 'store'])->name('menus.store');
            Route::get('/list',[MenuController::class, 'index'])->name('menus.index');
            Route::get('/edit/{menu}',[MenuController::class, 'show']);
            Route::post('/edit/{menu}',[MenuController::class, 'update'])->name('menus.update');
            Route::delete('/destroy',[MenuController::class, 'destroy']);
        });
        #product
        Route::prefix('/products')->group(function () {
            Route::get('/add',[ProductController::class, 'create'])->name('products.create');
            Route::post('/add/store',[ProductController::class, 'store'])->name('products.store');
            Route::get('/list',[ProductController::class, 'index'])->name('products.list');
            Route::get('/edit/{product}',[ProductController::class, 'show']);
            Route::post('/edit/{product}',[ProductController::class, 'update']);
            Route::delete('/destroy',[ProductController::class, 'destroy']);
        });
        #sliders
        Route::prefix('/sliders')->group(function () {
            Route::get('/add',[SliderController::class, 'create'])->name('sliders.create');
            Route::post('/add/store',[SliderController::class, 'store'])->name('sliders.store');
            Route::get('/list',[SliderController::class, 'index'])->name('sliders.list');
           Route::get('/edit/{slider}',[SliderController::class, 'show']);
           Route::post('/edit/{slider}',[SliderController::class, 'update']);
          Route::delete('/destroy',[SliderController::class, 'destroy']);
        });
        #upload
        Route::post('upload/services', [\App\Http\Controllers\Admin\UploadController::class, 'store']);
        #carts
        Route::get('/customers',[CartController::class, 'index'])->name('customers');
        Route::get('/customers/view/{customer}',[CartController::class, 'show']);
    });
    
});
Route::get('/',[HomeController::class, 'index']);
Route::post('/services/load-product',[HomeController::class, 'LoadProduct']);
Route::get('/danh-muc/{id}-{slug}.html',[\App\Http\Controllers\MenuController::class, 'index']);
Route::get('/san-pham/{id}-{slug}.html',[\App\Http\Controllers\ProductController::class, 'index']);
Route::post('/add-cart',[\App\Http\Controllers\CartController::class, 'index']);
Route::get('/carts',[\App\Http\Controllers\CartController::class, 'show'])->name('carts');
Route::post('/update-cart',[\App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
Route::get('/carts/delete/{id}',[\App\Http\Controllers\CartController::class, 'remove']);
Route::post('/carts',[\App\Http\Controllers\CartController::class, 'addcart'])->name('cart.add');