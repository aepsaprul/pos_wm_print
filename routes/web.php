<?php

use App\Http\Controllers\PrintController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('inventory_invoice', [PrintController::class, 'index'])->name('inventory_invoice');
Route::get('inventory_invoice/{id}/show', [PrintController::class, 'show'])->name('inventory_invoice.show');
Route::post('inventory_invoice/print', [PrintController::class, 'print'])->name('inventory_invoice.print');
