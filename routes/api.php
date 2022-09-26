<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RouteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('product/list', [RouteController::class, 'productList']);
Route::get('product/category', [RouteController::class, 'productCategory']);
Route::get('product/orderList', [RouteController::class, 'productOrderList']);
Route::post('category/create', [RouteController::class, 'categoryCreate']);
Route::post('contact/create', [RouteController::class, 'contactCreate']);
Route::post('category/delete', [RouteController::class, 'categoryDelete']);
Route::get('product/category/{id}',  [RouteController::class, 'categoryDetail']);
Route::post('product/category/update', [RouteController::class, 'categoryUpdate']);
