<?php

use Illuminate\Support\Facades\Route;
use App\Mail\NewUserWelcomeMail;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\FollowsController;
use App\Http\Controllers\HomeController;

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

Auth::routes();




Route::get('/email', function () {

    return new NewUserWelcomeMail();
});

Route::get('/', function() {
    return view('welcome');
});


//Route::get('/p/create', [PostsController::class, 'create'])->middleware('auth');
//Route::post('/p', [PostsController::class, 'store'])->middleware('auth');


Route::get('/index', [PostsController::class, 'index'])->name('posts.index');
Route::get('/posts/myIndex', [PostsController::class, 'myIndex'])->name('posts.myIndex');



Route::get('/profiles/{user}', [ProfilesController::class, 'index'])->name('profiles.show')->middleware('auth');
Route::patch('/profiles/{user}', [ProfilesController::class, 'update'])->name('profiles.update')->middleware('auth');
Route::get('/profiles/{id}/edit', [ProfilesController::class, 'edit'])->name('profiles.edit')->middleware('auth');

Route::post('/profiles/{profile}/follows', [FollowsController::class, 'store'])->name('profiles.follows')->middleware('auth');
Route::delete('/profiles/{profile}/follows', [FollowsController::class, 'destroy'])->name('profiles.unfollows')->middleware('auth');


Route::resource('posts', PostsController::class);
Route::resource('follows', FollowsController::class)->middleware('auth');
//Route::resource('profiles', ProfilesController::class)->middleware('auth');


//Route::post('follow/{user}', );




