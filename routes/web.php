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

Auth::routes();

$all_user = [
    'prefix' => '/',
    'middleware' => ['auth'],
];
Route::group($all_user, function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('home');

    Route::group(['prefix' => 'user'], function () {
        Route::get('/', 'UserController@index')->name('user')->middleware('isAdmin');
        Route::get('/create', 'UserController@create')->name('user.create')->middleware('isAdmin');
        Route::get('/{id}', 'UserController@show')->name('user.show');
        Route::post('/', 'UserController@store')->name('user.create.submit')->middleware('isAdmin');
        Route::put('/{id}', 'UserController@update')->name('user.update');
        Route::delete('/{id}', 'UserController@destroy')->name('user.delete')->middleware('isAdmin');
    });

    Route::group(['prefix' => 'file-undangan'], function () {
        Route::get('/', 'FileUndanganController@index')->name('file-undangan');
        Route::get('/create', 'FileUndanganController@create')->name('file-undangan.create')->middleware('isAdmin');
        Route::get('/{id}', 'FileUndanganController@show')->name('file-undangan.show')->middleware('isAdmin');
        Route::post('/', 'FileUndanganController@store')->name('file-undangan.create.submit')->middleware('isAdmin');
        Route::put('/{id}', 'FileUndanganController@update')->name('file-undangan.update')->middleware('isAdmin');
        Route::delete('/{id}', 'FileUndanganController@destroy')->name('file-undangan.delete')->middleware('isAdmin');
    });

    Route::group(['prefix' => 'jadwal-kegiatan'], function () {
        Route::get('/', 'JadwalKegiatanController@index')->name('jadwal-kegiatan');
        Route::get('/create', 'JadwalKegiatanController@create')->name('jadwal-kegiatan.create')->middleware('isAdmin');
        Route::get('/{id}', 'JadwalKegiatanController@show')->name('jadwal-kegiatan.show');
        Route::get('/{id}/edit', 'JadwalKegiatanController@edit')->name('jadwal-kegiatan.edit')->middleware('isAdmin');
        Route::post('/', 'JadwalKegiatanController@store')->name('jadwal-kegiatan.create.submit')->middleware('isAdmin');
        Route::put('/{id}', 'JadwalKegiatanController@update')->name('jadwal-kegiatan.update')->middleware('isAdmin');
        Route::put('/{id}/change-status', 'JadwalKegiatanController@changeStatus')->name('jadwal-kegiatan.changeStatus');
        Route::delete('/{id}', 'JadwalKegiatanController@destroy')->name('jadwal-kegiatan.delete')->middleware('isAdmin');
        Route::delete('/{id}/detail', 'JadwalKegiatanController@destroyDetail')->name('jadwal-kegiatan.detail.delete')->middleware('isAdmin');
    });

});
