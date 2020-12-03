<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplierController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/logs', [App\Http\Controllers\LogController::class, 'index'])->name('logs');

//________________________________[Products]
Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products');
Route::get('/new_product', [App\Http\Controllers\ProductController::class, 'product_create'])->name('new_product');
Route::delete('product/{product}', [App\Http\Controllers\ProductController::class, 'product_delete'])->name('deleteproduct');
Route::get('view_product/{product}', [App\Http\Controllers\ProductController::class, 'product_view'])->name('view_product');
Route::post('view_product/{product}', [App\Http\Controllers\ProductController::class, 'product_edit'])->name('edit_product');
Route::resource('product', 'App\Http\Controllers\ProductController', [
        'only' => [
            'update' , 'index', 'store'
        ]
    ]);

//________________________________[Contracts]
Route::get('/contracts', [App\Http\Controllers\ContractController::class, 'index'])->name('contracts');
Route::get('/new_contract', [App\Http\Controllers\ContractController::class, 'contract_create'])->name('new_contract');
Route::delete('contract/{contract}', [App\Http\Controllers\ContractController::class, 'contract_delete'])->name('deletecontract');
Route::get('view_contract/{contract}', [App\Http\Controllers\ContractController::class, 'contract_view'])->name('view_contract');
Route::post('view_contract/{contract}', [App\Http\Controllers\ContractController::class, 'contract_edit'])->name('edit_contract');
Route::resource('contract', 'App\Http\Controllers\ContractController', [
        'only' => [
            'update' , 'index', 'store'
        ]
    ]);

//________________________________[Suppliers]
Route::get('/suppliers', [App\Http\Controllers\SupplierController::class, 'index'])->name('suppliers');
Route::get('/new_supplier', [App\Http\Controllers\SupplierController::class, 'supplier_create'])->name('new_supplier');
Route::delete('supplier/{supplier}', [App\Http\Controllers\SupplierController::class, 'supplier_delete'])->name('deletesupplier');
Route::get('view_supplier/{supplier}', [App\Http\Controllers\SupplierController::class, 'supplier_view'])->name('view_supplier');
Route::post('view_supplier/{supplier}', [App\Http\Controllers\SupplierController::class, 'supplier_edit'])->name('edit_supplier');
Route::resource('supplier', 'App\Http\Controllers\SupplierController', [
        'only' => [
            'update' , 'index', 'store'
        ]
    ]);
//new
