<?php

use UniSharp\LaravelFilemanager\Lfm;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminMediaContorller;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\CommentReplyController;
use App\Http\Controllers\AdminCategoriesController;
use App\Http\Controllers\AdminController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// post routes
Route::get('/post/{id}', [AdminPostController::class, 'post'])->name('blog.post');


Route::group(['middleware' => 'admin'], function () {

    //Admin Route
    Route::get('/admin-panel', [AdminController::class, 'index']);

    // Admin User Route
    Route::resource('/admin/users', AdminUserController::class);
    // Admin Post Route
    Route::resource('/admin/posts', AdminPostController::class);
    // Admin Categories Route
    Route::resource('/admin/categories', AdminCategoriesController::class);
    // Admin Media Route
    Route::resource('/admin/medias', AdminMediaContorller::class);
    Route::delete('/media/delete', [AdminMediaContorller::class, 'mediaDelete'])->name('media.delete');
    // Admin Commnet Route
    Route::resource('/admin/comments', PostCommentController::class);
    // Admin Comment Reply Route
    Route::resource('/admin/comment/replies', CommentReplyController::class);

});

// comments reply route
Route::post('comment/replies', [CommentReplyController::class, 'createReplay']);

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

