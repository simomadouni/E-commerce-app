<?php

use Illuminate\Support\Facades\Auth;


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

 Route::get('/', function () {
     return view('welcome');
});

Auth::routes();

 Route::get('/',[App\Http\Controllers\Frontend\FrontendController::class, 'index']);
 Route::get('/collections',[App\Http\Controllers\Frontend\FrontendController::class, 'categories']);
 Route::get('/collections/{category_slug}',[App\Http\Controllers\Frontend\FrontendController::class, 'products']);
 Route::get('/collections/{category_slug}/{product_slug}',[App\Http\Controllers\Frontend\FrontendController::class, 'productView']);

 Route::middleware(['auth'])->group(function()
 {
 Route::get('wishlist',[App\Http\Controllers\Frontend\WishlistController::class, 'index']);
 Route::get('cart',[App\Http\Controllers\Frontend\CartController::class, 'index']);
  Route::get('checkout',[App\Http\Controllers\Frontend\CheckoutController::class, 'index']);
 });

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function(){
    Route::get('dashboard',[App\Http\Controllers\Admin\DashboardController::class,'index']);

    Route::controller(App\Http\Controllers\SliderController::class)->group(function () {
        Route::get('sliders', 'index');
        Route::get('sliders/create', 'create');
        Route::post('sliders/create', 'store');
        Route::get('sliders/{slider}/edit', 'edit');
        Route::put('sliders/{slider}', 'update');
        Route::get('sliders/{slider}/delete', 'destroy');

    });
    //Category Routes
    Route::get('category',[CategoryController::class,'index']);
    Route::get('category/create',[CategoryController::class,'create']);
    Route::post('category',[CategoryController::class,'store']);
    Route::get('category/{category}/edit',[CategoryController::class,'edit']);
    Route::put('category/{id}',[CategoryController::class,'update']);
    Route::get('category/delete/{id}',[CategoryController::class,'destroy']);

    //Products Routes
    Route::get('products',[ProductController::class,'index']);
    Route::get('products/create',[ProductController::class,'create']);
    Route::post('products',[ProductController::class,'store']);
    Route::get('products/{product}/edit',[ProductController::class,'edit']);
    Route::put('products/{id}',[ProductController::class,'update']);
    Route::get('products/{product_id}/delete',[ProductController::class,'destroy']);
    Route::get('product-image/{product_image_id}/delete',[ProductController::class,'destroyImage']);

    Route::post('product-color/{prod_color_id}',[ProductController::class,'updateProdColorQty']);
    Route::get('product-color/{prod_color_id}/delete',[ProductController::class,'deleteProdColor']);


    Route::get('/brands', App\Http\Livewire\Brand\Index::class);

//Colors Routes
Route::get('colors',[ColorController::class,'index']);
Route::get('colors/create',[ColorController::class,'create']);
Route::post('colors/create',[ColorController::class,'store']);
Route::get('colors/{color}/edit',[ColorController::class,'edit']);
Route::put('colors/{id}',[ColorController::class,'update']);
Route::get('colors/{color_id}/delete',[ColorController::class,'destroy']);

});
