<?php

use App\Http\Controllers\DropdownController;
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
Route::get('phpmyinfo', function () {
    phpinfo();
})->name('phpmyinfo');

Route::get('/symbolic-link', function () {
    Artisan::call('storage:link');
});

//clear cache
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('clear-compiled');
    Artisan::call('config:clear');
    // Artisan::call('config:cache');
    return "Cache is cleared";
});

Route::fallback(function () {
    return view('errors.404');
});

Route::get('/login', 'App\Http\Controllers\LoginController@formlogin')->name('login')->middleware('guest');
Route::post('/login', 'App\Http\Controllers\LoginController@actionLogin')->name('action.login');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'App\Http\Controllers\DashboardController@index')->name('dashboard.index');
    Route::get('/logout', 'App\Http\Controllers\DashboardController@logout')->name('logout');

    Route::get('/users', 'App\Http\Controllers\UserController@index')->name('dashboard.users.index');
    Route::post('/users/action', 'App\Http\Controllers\UserController@action')->name('action.index');
    Route::get('/user/create', 'App\Http\Controllers\UserController@create')->name('dashboard.user.create');
    Route::post('/users/create', 'App\Http\Controllers\UserController@store')->name('dashboard.users.create');
    Route::get('/user/show/{id}', 'App\Http\Controllers\UserController@show')->name('dashboard.user.show');
    Route::get('/user/show1/{id}', 'App\Http\Controllers\UserController@show1')->name('dashboard.user.show1');
    Route::get('/user/edit/{id}', 'App\Http\Controllers\UserController@edit')->name('dashboard.user.edit');
    Route::post('/users/update', 'App\Http\Controllers\UserController@update')->name('dashboard.users.update');
    Route::get('/user/terminate/{id}', 'App\Http\Controllers\UserController@terminate')->name('dashboard.user.terminate');
    Route::post('/users/update2', 'App\Http\Controllers\UserController@update2')->name('dashboard.users.update2');
    Route::post('/users/delete', 'App\Http\Controllers\UserController@destroy')->name('dashboard.users.delete');
    Route::post('users/editpassword', 'App\Http\Controllers\UserController@editPassword')->name('dashboard.users.editpassword');
    Route::post('/users/updatepassword', 'App\Http\Controllers\UserController@updatePassword')->name('dashboard.users.updatepassword');
    Route::post('/users/upload', 'App\Http\Controllers\UserController@uploadUsers')->name('dashboard.users.upload');
    Route::get('/users/approval', 'App\Http\Controllers\UserController@approval')->name('user.approval');
    Route::post('/users/approve', 'App\Http\Controllers\UserController@approve')->name('dashboard.users.approve');
    Route::post('/users/approveall', 'App\Http\Controllers\UserController@approveall')->name('dashboard.users.approveall');
    Route::post('/users/decline', 'App\Http\Controllers\UserController@decline')->name('dashboard.users.decline');
    Route::post('/users/declineall', 'App\Http\Controllers\UserController@declineall')->name('dashboard.users.declineall');
    Route::post('/users/edit1', 'App\Http\Controllers\UserController@edit1')->name('dashboard.users.edit1');
    Route::post('/users/edit2', 'App\Http\Controllers\UserController@edit2')->name('dashboard.users.edit2');
});
