<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\App;
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

Route::get('/', function () {
    return view('public.index');
});

// test
Route::get('/template', function () {
    return view('dashboard.layouts.app');
});

// login page
Route::get('/login', function () {
    return view('dashboard.sign-in');
})->name("login")->middleware('guest');

// auth
Route::post('/login', [LoginController::class, 'authenticate'])->middleware('guest');

// logout
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');




// dashboard route

// admin
Route::get('dashboard/', [DashboardController::class, 'index'])->middleware('auth');

Route::get('dashboard/all-posts', [DashboardController::class, 'showAll'])->middleware('auth')->name("all-posts");

Route::get('dashboard/active-posts', [DashboardController::class, 'showActive'])->middleware('auth')->name("all-posts");

Route::get('dashboard/inactive-posts', [DashboardController::class, 'showArchived'])->middleware('auth')->name("all-posts");

Route::get('dashboard/search', [DashboardController::class, 'search'])->middleware('auth')->name("all-posts");

Route::get('dashboard/drafts', [DashboardController::class, 'draft'])->middleware('auth')->name('drafts');

Route::get('dashboard/drafts/search', [DashboardController::class, 'searchAllDrafts'])->middleware('auth')->name('drafts');

Route::get('dashboard/users', [DashboardController::class, 'users'])->middleware('auth');

Route::get('dashboard/create-user', [DashboardController::class, 'createUser'])->middleware('auth');

Route::post('dashboard/store-user', [DashboardController::class, 'storeUser'])->middleware('auth');

Route::get('dashboard/categories', [DashboardController::class, 'categories'])->middleware('auth');

Route::resource('/users', UserController::class)->middleware('auth');



// user
Route::get('dashboard/myposts', [DashboardController::class, 'myPosts'])->middleware('auth')->name('myposts');

Route::get(
    'dashboard/my-active-posts',
    function () {
        // call showActive func on DashboardController with argument
        return App::call('App\Http\Controllers\DashboardController@showActive', ['logged_user_only' => 'true']);
    }
)->middleware('auth')->name('myposts');

Route::get(
    'dashboard/my-inactive-posts',
    function () {
        // call showArchived func on DashboardController with argument
        return App::call('App\Http\Controllers\DashboardController@showArchived', ['logged_user_only' => 'true']);
    }
)->middleware('auth')->name('myposts');

Route::get('dashboard/myposts/search', function () {
    // call search func on DashboardController with argument
    return App::call('App\Http\Controllers\DashboardController@search', ['logged_user_only' => 'true']);
})->middleware('auth')->name('myposts');

Route::get('dashboard/mydrafts', [DashboardController::class, 'myDrafts'])->middleware('auth');

Route::get('dashboard/need-revisions', [DashboardController::class, 'needRevisions'])->middleware('auth');
Route::get('dashboard/need-revisions/{post:slug}', [DashboardController::class, 'post'])->middleware('auth');

Route::get('dashboard/myprofile', function () {
    return view('dashboard.user.myprofile');
})->middleware('auth');



// all users
Route::get('/dashboard/contents/{post:slug}', [DashboardController::class, 'post'])->middleware('auth');

// end dashboard route





// post route
Route::resource('posts', PostController::class)->middleware('auth');

Route::post('/dashboard/publish/{post:slug}', [PostController::class, 'publish'])->middleware('auth');
Route::post('/dashboard/enable/{post:slug}', [PostController::class, 'enable'])->middleware('auth');
Route::post('/dashboard/disable/{post:slug}', [PostController::class, 'disable'])->middleware('auth');

Route::post('/dashboard/revision/{post:slug}', [PostController::class, 'revision'])->middleware('auth');



// category route
Route::resource('/categories', CategoryController::class)->middleware('auth');




// public route
Route::get('/blog/{post:slug}', [PostController::class, 'show']);

// about
Route::get('/about', function() {
    return view('public.about');
});

// blog
Route::get('/blog', [PostController::class, 'index']);
