<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CurrencyController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/', [CountryController::class, 'index']);
Route::get('/countries', [CountryController::class, 'index'])->name('countries');
Route::get('/country/{id}', [ CountryController::class, 'view'])->name('country');
Route::get('/countries/fetch', [CountryController::class, 'fetch']);
Route::get('/currencies/fetch', [CurrencyController::class, 'fetch']);