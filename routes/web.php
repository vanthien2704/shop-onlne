<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PayController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('index');
});

Route::get('/productsgroup/{id}', [ProductController::class, 'productsgroup']);

Route::get('/productdetail/{id}', [ProductController::class, 'productdetail']);

Route::get('/login', function () {
    if (auth('web')->user()) {
        return redirect('/');
    }
    return view('user.login');
})->name('login');

Route::get('/register', function () {
    if (auth('web')->user()) {
        return redirect('/');
    }
    return view('user.register');
})->name('register');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/register', [AuthController::class, 'register']);

Route::post('/search', [SearchController::class, 'search']);

Route::middleware(['auth'])->group(function(){

    Route::get('/removecart/{id}', [ProductController::class, 'removeFromCart']);
    Route::get('/orders', [ProductController::class, 'vieworder']);
    Route::get('/removecartall', [ProductController::class, 'clearCart']);
    Route::post('/addtocart', [ProductController::class, 'addToCart']);
    Route::post('/updatecart', [ProductController::class, 'updateCart']);
    Route::get('/cart', [ProductController::class, 'viewCart']);
    Route::get('/logout', [AuthController::class, 'logout']);

    Route::post('/payment', [PayController::class, 'payment']);
    Route::post('/received', [PayController::class, 'received']);
    Route::get('/requestpayment', [PayController::class, 'requestpayment']);

    Route::get('/supplier', [SupplierController::class, 'supplier']);
    Route::post('/dkapply', [SupplierController::class, 'dkapply']);

    Route::post('/addcomment', [ProductController::class, 'addcomment']);
});

Route::middleware(['auth', App\Http\Middleware\AdminAuth::class])->group(function(){
    Route::get('/admin', [AdminController::class, 'admin']);

    Route::get('/admin/account', [AdminController::class, 'account']);
    Route::get('/admin/account/remove/{id}', [AdminController::class, 'removeaccount']);
    Route::get('/admin/account/edit/{id}', [AdminController::class, 'editaccount']);
    Route::post('/admin/account/edit', [AdminController::class, 'updateaccount']);
    Route::get('/admin/account/add', [AdminController::class, 'addaccount']);
    Route::post('/admin/account/add', [AdminController::class, 'registeraccount']);

    Route::get('/admin/products', [AdminController::class, 'products']);
    Route::get('/admin/products/edit/{id}', [AdminController::class, 'editproduct']);
    Route::get('/admin/products/remove/{id}', [AdminController::class, 'removeproduce']);
    Route::post('/admin/products/edit', [AdminController::class, 'updateproduct']);
    Route::get('/admin/products/add', [AdminController::class, 'addproduct']);
    Route::post('/admin/products/add', [AdminController::class, 'creatproduct']);

    Route::get('/admin/groupproducts', [AdminController::class, 'groupproducts']);
    Route::get('/admin/groupproducts/edit/{id}', [AdminController::class, 'editgroupproducts']);
    Route::get('/admin/groupproducts/remove/{id}', [AdminController::class, 'removegroupproducts']);
    Route::post('/admin/groupproducts/edit', [AdminController::class, 'updategroupproducts']);
    Route::get('/admin/groupproducts/add', [AdminController::class, 'addgroupproductst']);
    Route::post('/admin/groupproducts/add', [AdminController::class, 'creagroupproducts']);

    Route::get('/admin/bills', [AdminController::class, 'bills']);
    Route::get('/admin/bills/detail/{id}', [AdminController::class, 'detailbill']);
    Route::post('/admin/bills/edit', [AdminController::class, 'updatebill']);

    Route::get('/admin/bills/sendbill/{id}', [AdminController::class, 'sendbill']);

});

Route::middleware(['auth', App\Http\Middleware\SupplierAuth::class])->group(function(){
    Route::get('/supplier/dashboard', [SupplierController::class, 'dashboard']);
    Route::get('/supplier/products', [SupplierController::class, 'products']);
    Route::get('/supplier/products/edit/{id}', [SupplierController::class, 'editproduct']);
    Route::get('/supplier/products/remove/{id}', [SupplierController::class, 'removeproduce']);
    Route::post('/supplier/products/edit', [SupplierController::class, 'updateproduct']);
    Route::get('/supplier/products/add', [SupplierController::class, 'addproduct']);
    Route::post('/supplier/products/add', [SupplierController::class, 'creatproduct']);

    Route::get('/supplier/bills', [SupplierController::class, 'bills']);
    Route::get('/supplier/bills/detail/{id}', [SupplierController::class, 'detailbill']);
    Route::post('/supplier/bills/edit', [SupplierController::class, 'updatebill']);

    Route::get('/supplier/bills/sendbill/{id}', [SupplierController::class, 'sendbill']);
});