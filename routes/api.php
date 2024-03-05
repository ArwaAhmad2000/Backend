<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserLoginController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FeaturesController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\WishlistsController;
use App\Http\Controllers\TextSummarizationController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(UserLoginController::class)
    ->prefix('user')
    ->group(function () {
        Route::post('/register', 'register');
        Route::post('/login', 'login');
        Route::post('/logout', 'logout');
        Route::post('/refresh',  'refresh');
        Route::get('/user-profile', 'userProfile');
    });

Route::controller(AdminLoginController::class)
    ->prefix('admin')
    ->group(function () {
        Route::post('/register', 'register');
        Route::post('/login', 'login');
        Route::post('/logout', 'logout');
        Route::post('/refresh',  'refresh');
        Route::get('/admin-profile', 'adminProfile');
    });

Route::controller(AuthorController::class)
    ->prefix('author')
    ->group(function () {
        Route::post('/add', 'addAuthor')->middleware('auth:admin');
        Route::post('/edit/{id}', 'editAuthor')->middleware('auth:admin');
        Route::post('/delete/{id}', 'deleteAuthor')->middleware('auth:admin');
        Route::get('/show/{id}', 'showAuthorById');
        Route::get('/showAll', 'showAllAuthors');
    });

Route::controller(ArticlesController::class)
    ->prefix('article')
    ->group(function () {
        Route::post('/add', 'addArticle')->middleware('auth:admin');
        Route::post('/edit/{id}', 'editArticle')->middleware('auth:admin');
        Route::post('/delete/{id}', 'deleteArticle')->middleware('auth:admin');
        Route::get('/show/{id}', 'showArticleById');
        Route::get('/showAll', 'showAllArticles');
    });

Route::controller(CategoryController::class)
    ->prefix('category')
    ->group(function () {
        Route::post('/add', 'addCategory')->middleware('auth:admin');
        Route::post('/edit/{id}', 'editCategory')->middleware('auth:admin');
        Route::post('/delete/{id}', 'deleteCategory')->middleware('auth:admin');
        Route::get('/show/{id}', 'showCategoryById');
        Route::get('/showAll', 'showAllCategories');
    });

Route::controller(FeaturesController::class)
    ->prefix('feature')
    ->group(function () {
        Route::post('/add', 'addFeature')->middleware('auth:admin');
        Route::post('/edit/{id}', 'editFeature')->middleware('auth:admin');
        Route::post('/delete/{id}', 'deleteFeature')->middleware('auth:admin');
        Route::get('/show/{id}', 'showFeatureById');
        Route::get('/showAll', 'showAllFeatures');
    });

Route::controller(BookController::class)
    ->prefix('book')
    ->group(function () {
        Route::post('/add', 'addBook')->middleware('auth:admin');
        Route::post('/edit/{id}', 'editBook')->middleware('auth:admin');
        Route::post('/delete/{id}', 'deleteBook')->middleware('auth:admin');
        Route::get('/show/{id}', 'showBookById');
        Route::get('/showAll', 'showAllBooks');
        Route::get('/search/{title}', 'searchBook');
    });

Route::controller(ContactController::class)
    ->prefix('contact')
    ->group(function () {
        Route::post('/send', 'sendMessage')->middleware('auth:api');
        Route::get('/show/{id}', 'showContactById');
        Route::get('/showAll', 'showAllContacts');
    });

Route::controller(WishlistsController::class)
    ->prefix('wishlist')
    ->group(function () {
        Route::post('/add', 'addWishlist')->middleware('auth');
        Route::post('/delete/{id}', 'deleteWishlist')->middleware('auth');
        Route::get('/show/{id}', 'showWishlistById');
    });

Route::controller(UserController::class)
    ->prefix('user')
    ->middleware('auth:admin')
    ->group(function () {
        Route::get('/show', 'all');
        Route::delete('/{id}', 'delete');
    });

Route::controller(TextSummarizationController::class)
    ->prefix('samurize')
    ->group(function () {
        Route::post('/summarize', 'getRespone')->middleware('auth');
        // Route::post('/delete/{id}', 'deleteWishlist')->middleware('auth');
        // Route::get('/show/{id}', 'showWishlistById');
    });
