<?php

use App\Test;
use App\Container;
use App\TestFacade;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

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
// Route::get('/', [HomeController::class, 'testroot'])->name('root');

// Route::get('/', function(){
//     dd(TestFacade::execute());
// });
Route::resource('/', HomeController::class);

Route::resource('posts', HomeController::class)->middleware('auth');

Route::get('logout', [AuthController::class, 'logout']);

// Route::get('/posts', [HomeController::class, 'index'])->middleware(['auth:sanctum', 'verified']);
