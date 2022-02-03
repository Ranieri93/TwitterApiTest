<?php

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

Route::get('/', static function () {
    return view('welcome');
})->name('home');

Route::get('/search_by_user_ID', [\App\Http\Controllers\TwitterApiController::class, 'indexSearchByIds'])->name('search_by_ids');
Route::post('/search_by_user_ID', [\App\Http\Controllers\TwitterApiController::class, 'searchByIdsHandler'])->name('search_by_ids_handler');
Route::get('/tweet_something', [\App\Http\Controllers\TwitterApiController::class, 'indexTweet'])->name('tweet');


/**
 * Use these routes if you want to add user auth
 */
//Route::middleware(['auth'])->group(function () {
//    Route::get('/dashboard', static function () {
//        return view('dashboard');
//    })->name('dashboard');
//});
//require __DIR__.'/auth.php';
