<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[ProductController::class,'index'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth','admin'])->group(function(){

//Categories

    Route::get('/categories',[CategoryController::class,'index'])->name('categories.index');
    Route::get('/categories/create',[CategoryController::class,'create'])->name('categories.create');
    Route::post('/categories',[CategoryController::class,'store'])->name('categories.store');
    Route::get('/categories/{id}/edit',[CategoryController::class,'edit'])->name('categories.edit');
    Route::put('/categories/{id}',[CategoryController::class,'update'])->name('categories.update');
    Route::delete('/categories/{id}',[CategoryController::class,'delete'])->name('categories.delete');

  //Products
    Route::get('/products',[ProductController::class,'index'])->name('products.index');
    Route::get('/products/create',[ProductController::class,'create'])->name('products.create');
    Route::post('/products',[ProductController::class,'store'])->name('products.store');
    Route::get('/products/{id}/edit',[ProductController::class,'edit'])->name('products.edit');
    Route::put('/products/{id}',[ProductController::class,'update'])->name('products.update');
    Route::delete('/products/{id}',[ProductController::class,'delete'])->name('products.delete');


    /////

    Route::get('/admin/orders',[OrderController::class,'adminIndex'])->name('admin.orders.index');
    Route::put('/admin/orders/{id}',[OrderController::class,'updateStatus'])->name('admin.orders.update');
});
    

   Route::middleware(['auth','user'])->group(function(){

 ///Cart

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');

    Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');

    Route::delete('/cart/delete/{id}', [CartController::class, 'delete'])->name('cart.delete');


    //Order

    Route::get('/orders',[OrderController::class,'index'])->name('orders.index');
    Route::post('/orders',[OrderController::class,'store'])->name('orders.store');
    Route::get('/orders/{id}',[OrderController::class,'show'])->name('orders.show');

     //Payment
       Route::get('/payments/{orderId}/create', [PaymentController::class, 'create'])->name('payments.create');
    Route::post('/payments/{orderId}', [PaymentController::class, 'store'])->name('payments.store');
   });   


   


  



    
require __DIR__.'/auth.php';
