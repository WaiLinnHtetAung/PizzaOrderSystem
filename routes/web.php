<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\User\UserController;

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
    });




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
        });
    });

});






