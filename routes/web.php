<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\UserController;

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

Route::get('/', [\App\Http\Controllers\PostController::class, 'index'])->name('home');
Route::get('/article/{slug}', [\App\Http\Controllers\PostController::class, 'show'])->name('post.single');
Route::get('/category/{slug}', [\App\Http\Controllers\CategoryController::class, 'show'])->name('category.single');
Route::get('/tags/{slug}', [\App\Http\Controllers\TagController::class, 'show'])->name('tag.single');
Route::get('/search', [\App\Http\Controllers\SearchController::class, 'index'])->name('search');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'admin'], function () {
    Route::get('/', [MainController::class, 'index'])->name('admin.index');
    Route::resource('/categories', '\App\Http\Controllers\Admin\CategoryController');
    Route::resource('/tags', '\App\Http\Controllers\Admin\TagController');
    Route::resource('/posts', '\App\Http\Controllers\Admin\PostController');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [UserController::class, 'create'])->name('register.create');
    Route::post('/register', [UserController::class, 'store'])->name('register.store');
    Route::get('/login', [UserController::class, 'loginForm'])->name('login.create');
    Route::post('/login', [UserController::class, 'login'])->name('login');
});


Route::get('/logout', [UserController::class, 'logout'])->name('logout')->middleware('auth');
