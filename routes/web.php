<?php

use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Frontend\FrontendController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Frontend Routes
Route::get('/',[FrontendController::class,'index'])->name('front.index');
Route::get('/single-post',[FrontendController::class,'single'])->name('front.single');
Route::get('/about',[FrontendController::class,'about'])->name('front.about');

// Backend Routes
Route::group(['prefix'=>'dashboard'], function(){
    Route::get('/', [BackendController::class, 'index'])->name('back.index');
});



