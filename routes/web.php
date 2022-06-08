<?php

use App\Http\Controllers\CustomerController;
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

Route::get('/', [CustomerController::class, 'index'])->name('customer.index');
Route::post('/', [CustomerController::class, 'store'])->name('customer.store');
Route::get('/destroy/{id}', [CustomerController::class, 'destroy'])->name('customer.delete');
