<?php

use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\TagController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\ProfileController;
// use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

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
// Frontend
Route::get('/',[FrontendController::class, 'index'])->name('front.index');
Route::get('/single-post',[FrontendController::class, 'single'])->name('front.single');
Route::get('/about',[FrontendController::class, 'about'])->name('front.about');
Route::get('/contact',[FrontendController::class, 'contact'])->name('front.contact');

// Backend
// Routes group with Prefix, multi Middlewares and names
Route::group(['prefix'=>'dashboard', 'middleware'=>['auth','verified']],function(){
    Route::get('/',[BackendController::class, 'index'])->name('back.index');
    Route::get('/blank',[BackendController::class, 'blankPage'])->name('blank');
    Route::resource('/category', CategoryController::class);
    Route::resource('/tag', TagController::class);
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
