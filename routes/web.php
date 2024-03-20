<?php

use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\TagController;

use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PostCountController;
use App\Http\Controllers\ProfileController;
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
Route::get('/all-posts',[FrontendController::class, 'all_posts'])->name('front.all-posts');
Route::get('/search',[FrontendController::class, 'search'])->name('front.search');

Route::get('/category/{slug}',[FrontendController::class, 'category'])->name('front.category');
Route::get('/category/{cat_slug}/{sub_cat_slug}',[FrontendController::class, 'sub_category'])->name('front.sub-category');
Route::get('/tag/{tag}',[FrontendController::class, 'tag'])->name('front.tag');
Route::get('/single-post/{slug}',[FrontendController::class, 'single'])->name('front.single');
Route::get('/post-count/{post_id}',[FrontendController::class, 'postReadCount']);

Route::get('/about',[FrontendController::class, 'about'])->name('front.about');
Route::get('/contact',[FrontendController::class, 'contact'])->name('front.contact');
Route::post('/contact',[ContactController::class, 'store'])->name('contact.store');

Route::get('/get-district/{division_id}',[ProfileController::class, 'getDistrict'])->name('get-district');
Route::get('/get-thana/{district_id}',[ProfileController::class, 'getThana'])->name('get-thana');

Route::get('/lang/{lang}', [LanguageController::class, 'switchLang'])->name('lang.switch');

// Backend
// Routes group with Prefix, multi Middlewares and names
Route::group(['prefix'=>'dashboard', 'middleware'=>['auth','verified']],function(){

    Route::get('/',[BackendController::class, 'index'])->name('back.index');
    Route::get('/blank',[BackendController::class, 'blankPage'])->name('blank');
    Route::post('upload-profile-photo', [ProfileController::class, 'uploadProfilePhoto']);
    Route::get('/get-subcategory/{id}', [SubCategoryController::class, 'getSubCategoryByCategoryId']);
    Route::resource('/post', PostController::class);
    Route::resource('/comment', CommentController::class);
    Route::resource('/profile', ProfileController::class);

    Route::group(['middleware'=>'admin'], function(){
        Route::resource('/category', CategoryController::class);
        Route::resource('/sub-category', SubCategoryController::class);
        Route::resource('/tag', TagController::class);





    });







});

require __DIR__.'/auth.php';
