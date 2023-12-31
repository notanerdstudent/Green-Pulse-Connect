<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\ProductController;
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

// Home Route
Route::view('/', 'frontend.pages.home')->name('home');

// Blog Routes
Route::view('/blog', 'frontend.pages.blog')->name('blog');
Route::get('/article/{any}', [BlogController::class, 'readPost'])->name('read_post');
Route::get('/category/{any}', [BlogController::class, 'categoryPosts'])->name('category_posts');
Route::get('/posts/tag/{any}', [BlogController::class, 'tagPosts'])->name('tag_posts');
Route::get('/search', [BlogController::class, 'searchBlog'])->name('search_posts');

// Business Listing Routes
Route::get('/business', [BusinessController::class, 'index'])->name('business');
Route::get('/business/{any}', [BusinessController::class, 'show'])->name('business.show');

// Product Reviews Routes
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/products/{any}', [ProductController::class, 'show'])->name('product.single');
