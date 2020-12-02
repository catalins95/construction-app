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
Route::get('/new_supplier', [App\Http\Controllers\SupplierController::class, 'supplier_create']);
Route::resource('supplier', 'SupplierController', [
        'only' => [
            'update' , 'index', 'store'
        ]
    ]);
//new
