<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostcodeController;

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

Route::get('/', [PostcodeController::class, 'index']);
Route::post('/', [PostcodeController::class, 'compare']);
