<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScraperController;
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

Route::get('/', [ScraperController::class, 'all']);
Route::get('/store', [ScraperController::class, 'store']);
Route::put('/update/{id}', [ScraperController::class, 'update']);
