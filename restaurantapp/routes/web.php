<?php

use App\Http\Controllers\Cashier\CashierController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Management\CategoryController;
use App\Http\Controllers\Management\MenuController;
use App\Http\Controllers\Management\TableController;
use App\Http\Controllers\Management\UserController;
use App\Http\Controllers\Report\ReportController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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



Route::get('/', [HomeController::class, 'index']);

Auth::routes(['register' => false, 'reset' => false]);




//Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');



Route::middleware(['auth'])->group(function(){


Route::get('/management', function(){
return view('management.index');
});


//Routes for management
Route::resource('management/category', CategoryController::class);
Route::resource('management/menu',     MenuController::class);
Route::resource('management/table',    TableController::class);
Route::resource('management/user',     UserController::class);


// Routes for cashier
Route::get('/cashier', [CashierController::class, 'index']);
Route::get('/cashier/getMenuByCategory/{category_id}', [CashierController::class, 'getMenuByCategory']);
Route::get('/cashier/getTable', [CashierController::class, 'getTables']);
Route::get('/cashier/getSaleDetailsByTable/{table_id}', [CashierController::class, 'getSaleDetailsByTable']);

Route::post('/cashier/orderFood',           [CashierController::class, 'orderFood']);
Route::post('/cashier/deleteSaleDetail',    [CashierController::class, 'deleteSaleDetail']);
Route::post('/cashier/increase-quantity',    [CashierController::class, 'increaseQuantity']);
Route::post('/cashier/decrease-quantity',    [CashierController::class, 'decreaseQuantity']);

Route::post('/cashier/confirmOrderStatus',  [CashierController::class, 'confirmOrderStatus']);
Route::post('/cashier/savePayment', [CashierController::class, 'savePayment']);
Route::get('/cashier/showReceipt/{saleID}', [CashierController::class, 'showReceipt']);

Route::get('/report', [ReportController::class, 'index']);
Route::get('/report/show', [ReportController::class, 'show']);

// Export to excel
//Route::get('/report/show/export', [ReportController::class, 'export']);



});