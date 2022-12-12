<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Artisan;
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

Route::middleware(['auth'])
    ->group(function () {
        Route::get('/', [PostController::class, 'timeline'])->name('home');
        Route::get('/saves', [SiteController::class, 'saves'])->name('saves');
        Route::get('/people', [SiteController::class, 'people'])->name('people');
        Route::get('/search', [PostController::class, 'index'])->name('search');
    });

Route::prefix('profile')
    ->middleware(['auth'])
    ->controller(ProfileController::class)
    ->name('profile.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{profile:username}/edit', 'edit')->name('edit');
        Route::put('/{profile:username}', 'update')->name('update');
        Route::get('/{profile:username}', 'show')->name('show');
        Route::post('/{profile:username}/follow', 'follow')->name('follow');
        Route::delete('/{profile:username}/delete-photo', 'deletePhoto')->name('delete-photo');
    });

Route::prefix('/post')
    ->middleware(['auth'])
    ->controller(PostController::class)
    ->name('post.')
    ->group(function () {
        Route::get('/create', 'create')->name('create');
        Route::get('/{post}', 'show')->name('show');
        Route::post('/', 'store')->name('store');
        Route::post('/{post}/save', 'save')->name('save');
        Route::post('/{post}/like', 'like')->name('like');
    });

Route::prefix('comment')
    ->middleware(['auth'])
    ->controller(CommentController::class)
    ->name('comment.')
    ->group(function () {
        Route::post('/create', 'store')->name('store');
        Route::delete('/{comment}', 'destroy')->name('destroy');
    });
;

require __DIR__ . '/auth.php';
