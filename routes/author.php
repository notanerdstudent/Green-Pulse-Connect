<?php

use App\Http\Controllers\AuthorController;
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

Route::prefix('author')->name('author.')->group(function () {
    Route::middleware(['guest:web'])->group(function () {
        Route::view('/login', 'backend.pages.auth.login')->name('login');
        Route::view('/signup', 'backend.pages.auth.signup')->name('signup');
        Route::view('forgot-password', 'backend.pages.auth.forgot')->name('forgot-password');
        Route::get('/password/reset/{token}', [AuthorController::class, 'resetForm'])->name('reset-form');
    });
    Route::middleware(['auth:web'])->group(function () {
        Route::redirect('/', '/author/profile', 302)->name('home');
        Route::redirect('/home', '/author/profile', 302);
        Route::post('/logout', [AuthorController::class, 'logout'])->name('logout');
        Route::view('/profile', 'backend.pages.profile')->name('profile');
        Route::post('/change-profile-picture', [AuthorController::class, 'changeProfilePicture'])->name('change-profile-picture');

        Route::middleware(['admin'])->group(function () {
            Route::view('/settings', 'backend.pages.settings')->name('settings');
            Route::view('/authors', 'backend.pages.authors')->name('authors');
            Route::view('/categories', 'backend.pages.categories')->name('categories');
            Route::view('/forum-categories', 'backend.pages.forum-categories')->name('forum-categories');
            Route::post('/change-blog-logo', [AuthorController::class, 'changeBlogLogo'])->name('change-blog-logo');
            Route::post('/change-blog-favicon', [AuthorController::class, 'changeBlogFavicon'])->name('change-blog-favicon');
        });

        Route::prefix('posts')->name('posts.')->group(function () {
            Route::view('/add-post', 'backend.pages.add-post')->name('add-post');
            Route::post('/create', [AuthorController::class, 'createPost'])->name('create');
            Route::view('/all', 'backend.pages.all_posts')->name('all-posts');
            Route::get('/edit-post', [AuthorController::class, 'editPost'])->name('edit-post');
            Route::post('/update-post', [AuthorController::class, 'updatePost'])->name('update-post');
        });

        Route::prefix('business')->name('business.')->group(function () {
            Route::view('/add-business', 'backend.pages.add-business')->name('add-business');
            Route::post('/create', [AuthorController::class, 'createBusiness'])->name('create');
            Route::view('/all', 'backend.pages.all_business')->name('all-business');
            Route::get('/edit-business', [AuthorController::class, 'editBusiness'])->name('edit-business');
            Route::post('/update-business', [AuthorController::class, 'updateBusiness'])->name('update-business');
        });

        Route::prefix('products')->name('products.')->group(function () {
            Route::view('/add-product', 'backend.pages.add-product')->name('add-product');
            Route::post('/create', [AuthorController::class, 'createProduct'])->name('create');
            Route::view('/all', 'backend.pages.all_products')->name('all-products');
            Route::get('/edit-product', [AuthorController::class, 'editProduct'])->name('edit-product');
            Route::post('/update-product', [AuthorController::class, 'updateProduct'])->name('update-product');
        });
    });
});
