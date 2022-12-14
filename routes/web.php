<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\SortingController;

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



//login , register
Route::middleware(['admin_auth'])->group( function() {
    Route::redirect('/', 'loginPage');
    Route::get('loginPage', [AuthController::class, 'loginPage'])->name('auth#loginPage');
    Route::get('registerPage', [AuthController::class, 'registerPage'])->name('auth#registerPage');
});


Route::middleware(['auth'])->group(function () {


    //dashboard
    Route::get('dashboard',[AuthController::class, 'dashboard'] )->name('dashboard');

    // admin
    Route::middleware(['admin_auth'])->group( function() {

        //category
        Route::prefix('category')->group(function() {
            Route::get('list', [CategoryController::class, 'list'])->name('category#list');
            Route::get('create/page', [CategoryController::class, 'createPage'])->name('category#createPage');
            Route::post('create', [CategoryController::class, 'create'])->name('category#create');
            Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('category#delete');
            Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('category#edit');
            Route::post('update', [CategoryController::class, 'update'])->name('category#update');
        });

        //Account
        Route::prefix('admin')->group(function() {

            //password
            Route::get('password/changePage', [AdminController::class, 'changePasswordPage'])->name('admin#changePasswordPage');
            Route::post('change/password', [AdminController::class, 'changePassword'])->name('admin#changePassword');

            //profile
            Route::get('profile', [AdminController::class, 'profile'])->name('admin#profile');
            Route::get('edit', [AdminController::class, 'edit'])->name('admin#edit');
            Route::post('update/{id}', [AdminController::class, 'update'])->name('admin#update');

            //Admin list
            Route::get('list', [AdminController::class, 'list'])->name('admin#list');
            Route::get('delete/{id}', [AdminController::class, 'delete'])->name('admin#delete');
            Route::get('change/{role}/{id}', [AdminController::class, 'changeRole'])->name('admin#changeRole');
        });

        //Products
        Route::prefix('products')->group(function() {
            Route::get('list', [ProductController::class, 'list'])->name("products#list");
            Route::get('create', [ProductController::class, 'createPage'])->name('products#createPage');
            Route::post('create', [ProductController::class, 'create'])->name('products#create');
            Route::get('delete/{id}', [ProductController::class, 'delete'])->name('products#delete');
            Route::get('detail/{id}', [ProductController::class, 'detail'])->name('products#detail');
            Route::get('edit/{id}', [ProductController::class, 'editPage'])->name('products#editPage');
            Route::post('update/{id}', [ProductController::class, 'update'])->name('products#update');
        });

        //Order List
        Route::prefix('order')->group(function() {
            Route::get('list', [OrderController::class, 'orderList'])->name('order#list');
            Route::get('status', [OrderController::class, 'orderStatus'])->name('order#status');
            Route::get('changeStatus', [OrderController::class, 'changeStatus'])->name('change#status');
            Route::get('orderInfo/{orderCode}', [OrderController::class, 'orderInfo'])->name('order#info');
        });

        //user list
        Route::get('user/list', [AdminUserController::class, 'userList'])->name('user#list');
        Route::get('user/change', [AdminUserController::class, 'changeRole'])->name('user#change');

        //contact message
        Route::get('customer/messages', [AdminController::class, 'messages'])->name('customer#messages');

    });

        // --- view count---
        Route::get('product/viewCount', [AdminUserController::class, 'viewCount'])->name('increase#viewCount');


    // user
    Route::group(['prefix' => 'user', 'middleware' => 'user_auth'], function() {

        Route::get('home', [UserController::class, 'home'])->name('user#home');

        //password
        Route::prefix('password')->group(function() {
            Route::get('change', [UserController::class, 'changePage'])->name('password#changePage');
            Route::post('change', [UserController::class, 'changePassword'])->name('password#change');
        });

        //profile
        Route::prefix('profile')->group(function() {
            Route::get('edit', [UserController::class, 'editPage'])->name('profile#editPage');
            Route::post('update/{id}', [UserController::class, 'updatePage'])->name('profile#updatePage');
        });

        //sorting
        Route::get('sort/list', [SortingController::class, 'pizzaList'])->name('sort#pizzaList');

        //product category
        Route::get('filter/{id}', [UserController::class, 'filter'])->name('filter#category');

        //product detail and cart
        Route::prefix('product')->group(function() {
            Route::get('detail/{id}', [UserController::class, 'productDetail'])->name('product#detail');

            // Route::get('cart',class, 'addCart'])->name('add#cart');
            Route::post('cart', [CartController::class, 'addCart'])->name('add#cart');
            Route::get('cart', [CartController::class, 'cart'])->name('cart#items');

            //proceed to checkout
            Route::get('checkout', [CartController::class, 'order'])->name('product#order');
            Route::get('order/history', [CartController::class, 'history'])->name('order#history');
            Route::get('clear/cart', [CartController::class, 'clearCart'])->name('clear#cart');
            Route::get('clear/cartRow', [CartController::class, 'clearRow'])->name('clear#cartRow');
        });

        //contact
        Route::get('/contact', [ContactController::class, 'contact'])->name('user#contact');
        Route::post('/contact/message', [ContactController::class, 'message'])->name('contact#message');

    });

});






