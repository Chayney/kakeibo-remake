<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KakeiboController;

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

Route::get('/', [KakeiboController::class, 'index']);
Route::post('/kakeibo', [KakeiboController::class, 'store']);
Route::get('/edit/{id}', [KakeiboController::class, 'edit']);