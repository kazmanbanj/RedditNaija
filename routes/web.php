<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\CommunityPostController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Auth::routes(['verify' => true]);

Route::get('c/{slug}', [CommunityController::class, 'show'])->name('communities.show');
Route::get('p/{postId}', [CommunityPostController::class, 'show'])->name('communities.posts.show');

Route::group(['middleware' => ['auth', 'verified']], function() {
    Route::resource('communities', CommunityController::class)->except('show');
    Route::resource('communities.posts', CommunityPostController::class)->except('show');
    Route::resource('posts.comments', PostCommentController::class);
    Route::get('posts/{post_id}/vote/{vote}', [\App\Http\Controllers\CommunityPostController::class, 'vote'])->name('post.vote');
    Route::post('posts/{post_id}/report', [\App\Http\Controllers\CommunityPostController::class, 'report'])->name('post.report');
});

