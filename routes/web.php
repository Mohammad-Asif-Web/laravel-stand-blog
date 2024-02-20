<?php

use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\SubCategoryController;
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
Route::get('/category/{slug}',[FrontendController::class, 'index'])->name('front.category');
Route::get('/category/{cat_slug}/{sub_cat_slug}',[FrontendController::class, 'index'])->name('front.sub-category');
Route::get('/tag/{tag}',[FrontendController::class, 'index'])->name('front.tag');
Route::get('/single-post/{slug}',[FrontendController::class, 'single'])->name('front.single');
Route::get('/about',[FrontendController::class, 'about'])->name('front.about');
Route::get('/contact',[FrontendController::class, 'contact'])->name('front.contact');

// Backend
// Routes group with Prefix, multi Middlewares and names
Route::group(['prefix'=>'dashboard', 'middleware'=>['auth','verified']],function(){
    Route::get('/',[BackendController::class, 'index'])->name('back.index');
    Route::get('/blank',[BackendController::class, 'blankPage'])->name('blank');
    Route::resource('/category', CategoryController::class);
    // Get Sub Category by Cateogory Id Custom api Route
    Route::get('/get-subcategory/{id}', [SubCategoryController::class, 'getSubCategoryByCategoryId']);
    Route::resource('/sub-category', SubCategoryController::class);
    Route::resource('/tag', TagController::class);
    Route::resource('/post', PostController::class);
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
