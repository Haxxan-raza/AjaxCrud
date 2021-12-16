<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxPostController;
use App\Models\Post;
use App\Http\Middleware\CheckType;

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
// Route::resource('/dashboard', 'AjaxPostController');


Auth::routes(['verify' => true]);

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/dashboard',[App\Http\Controllers\AjaxPostController::class,'index'])->name('dashboard')->middleware('type');
    Route::post('/store',[App\Http\Controllers\AjaxPostController::class,'store'])->name('store');
    Route::post('/edit/{id}',[App\Http\Controllers\AjaxPostController::class,'edit'])->name('edit');
    Route::delete('/delete/{id}',[App\Http\Controllers\AjaxPostController::class,'destroy'])->name('delete');
  
});


