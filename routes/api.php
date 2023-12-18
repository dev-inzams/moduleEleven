<?php

use App\Http\Controllers\CustomersController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/get_all_invoice', [InvoicesController::class, 'get_all_invoice']);
Route::get('/create_invoice', [InvoicesController::class, 'create_invoice']);
Route::get('/customers', [CustomersController::class, 'all_customers']);
Route::get('/products', [ProductsController::class, 'all_products']);
Route::get('/show_products', [ProductsController::class, 'show_products']);
Route::post('/add_invoice', [InvoicesController::class, 'add_invoice']);


Route::post('/add-product', [ProductsController::class, 'add_product']);
Route::get('/todaytotalsell', [dashboardController::class, 'todayTotalSell']);
Route::get('/thisMonthTotalSell', [dashboardController::class, 'thisMonthTotalSell']);
Route::get('/thisYearTotalSell', [dashboardController::class, 'thisYearTotalSell']);

