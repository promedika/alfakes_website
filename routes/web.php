<?php

use App\Http\Controllers\DropdownController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

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
    return view('frontend.404');
});

Route::get('/', 'App\Http\Controllers\FrontendController@feHome')->name('home.index');
Route::get('/list-of-members', 'App\Http\Controllers\FrontendController@feMembers')->name('list-members.index');
Route::get('/price-list-ipm', 'App\Http\Controllers\FrontendController@feIPMPrice')->name('price-list-ipm.index');
Route::get('/price-list-kalibrasi', 'App\Http\Controllers\FrontendController@feCalibrationPrice')->name('price-list-kalibrasi.index');
Route::get('/member/{id}', 'App\Http\Controllers\FrontendController@feMemberDetail')->name('member.index');
Route::get('/contact-us', 'App\Http\Controllers\FrontendController@feContactUs')->name('contact-us.index');
Route::get('/about-us', 'App\Http\Controllers\FrontendController@feAboutUs')->name('about-us.index');
Route::post('/send-email', 'App\Http\Controllers\FrontendController@feSendEmail')->name('send-email.store');

Route::get('/login', 'App\Http\Controllers\LoginController@formlogin')->name('login')->middleware('guest');
Route::post('/login', 'App\Http\Controllers\LoginController@actionLogin')->name('action.login');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard.index');
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

    Route::get('/peserta', 'App\Http\Controllers\PesertaController@index')->name('peserta.index');
    Route::post('/peserta/create', 'App\Http\Controllers\PesertaController@store')->name('peserta.create');
    Route::post('/peserta/edit', 'App\Http\Controllers\PesertaController@edit')->name('peserta.edit');
    Route::post('/peserta/update', 'App\Http\Controllers\PesertaController@update')->name('peserta.update');
    Route::post('/peserta/delete', 'App\Http\Controllers\PesertaController@destroy')->name('peserta.delete');

    Route::get('/price_lists', 'App\Http\Controllers\PriceListsController@index')->name('price_lists.index');
    Route::post('/price_lists/store', 'App\Http\Controllers\PriceListsController@store')->name('price_lists.store');
    Route::post('/price_lists/edit', 'App\Http\Controllers\PriceListsController@edit')->name('price_lists.edit');
    Route::post('/price_lists/update', 'App\Http\Controllers\PriceListsController@update')->name('price_lists.update');
    Route::post('/price_lists/delete', 'App\Http\Controllers\PriceListsController@destroy')->name('price_lists.delete');

    Route::get('/members', 'App\Http\Controllers\MembersController@index')->name('members.index');
    Route::post('/members/store', 'App\Http\Controllers\MembersController@store')->name('members.store');
    Route::post('/members/edit', 'App\Http\Controllers\MembersController@edit')->name('members.edit');
    Route::post('/members/update', 'App\Http\Controllers\MembersController@update')->name('members.update');
    Route::post('/members/delete', 'App\Http\Controllers\MembersController@destroy')->name('members.delete');

});
