<?php

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

Route::get('/dashboard', 'HomeController@index')->name('dashboard');

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');


Route::get('/social_login/{provider}', 'SocialController@login');
Route::get('/social_login/callback/{provider}', 'SocialController@callback');
Route::group(['middleware' => ['auth'], 'prefix' => 'dashboard'], function () {


    Route::group(['middleware' => ['auth'], 'prefix' => 'profile'], function () {
//        Route::any('/', 'Dashboard\ProfileController@showProfilePage')->name('userProfilePage');
        Route::get('/edit', 'Dashboard\ProfileController@editProfilePage')->name('editUserProfilePage');
        Route::get('/{id}', 'Dashboard\ProfileController@showProfilePage')->name('userProfilePage');
//        showProfilePage
        Route::post('/save', 'Dashboard\ProfileController@saveProfile')->name('saveUsersProfileProcess');
    });
    Route::group(['middleware' => ['auth'], 'prefix' => 'adverts'], function () {
        Route::get('/show_user_adverts', 'Dashboard\AdvertsController@showUserAdverts')->name('showUserAdverts');
        Route::get('/delete/{advert_id}', 'Dashboard\AdvertsController@deleteAdvert')->name('deleteAdvert');
        Route::get('/edit/{advert_id}', 'Dashboard\AdvertsController@editAdvert')->name('editAdvert');
        Route::post('/edit', 'Dashboard\AdvertsController@postEditAdvert')->name('postEditAdvert');
        Route::get('/add', 'Dashboard\AdvertsController@addAdvert')->name('addAdvert');
//        Route::get('/edit/{id}', '')->name('advertEditPage');
//        Route::get('/add', '')->name('advertAddPage');
    });


});