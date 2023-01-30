<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PengajuanController;
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

// Route::get('/', function () {
//     return view('login');
// });
// Route::get('/login', function () {
//     return view('login');
// });
Route::get('/', 'LoginController@viewlogin')->name('home');
Route::get('/login', 'LoginController@viewlogin')->name('home');
Route::get('daftar', 'LoginController@viewregister')->name('register');

Route::get('/logout', 'LoginController@Logout')->name('logout');
// Route::get('/daftar', function () {
//     return view('register');
// });

Route::post('/postDaftar', 'LoginController@postDaftar')->name('postDaftar');
Route::post('/postLogin', 'LoginController@postLogin')->name('postLogin');
Route::get('/agenda', 'LoginController@Agenda')->name('Agenda');


//pengajuan
Route::get('/pengajuan', 'PengajuanController@index')->name('pengajuan');
Route::get('/pengajuan/create', 'PengajuanController@create')->name('pengajuan/create');
Route::post('/pengajuan/simpan', 'PengajuanController@store')->name('pengajuan/simpan');
Route::get('/pengajuan/edit/{id}', 'PengajuanController@edit')->name('pengajuan/edit');
Route::post('/pengajuan/update/{id}', 'PengajuanController@update')->name('pengajuan/update');
Route::get('/delete_pesan/{id}', 'PengajuanController@destroy')->name('delete_pesan');
Route::post('pengajuan/cektempat', 'PengajuanController@cektempat')->name('pengajuan.cektempat');
	//user daftar saya
Route::get('/pengajuan/daftarsaya/hariini', 'PengajuanController@daftarsayahariini')->name('pengajuan/daftarsaya/hariini');
Route::get('/pengajuan/daftarsaya/bulanini', 'PengajuanController@daftarsayabulanini')->name('pengajuan/daftarsaya/bulanini');
Route::get('/pengajuan/daftarsaya/tahunini', 'PengajuanController@daftarsayatahunini')->name('pengajuan/daftarsaya/tahunini');
Route::get('/pengajuan/daftarsaya/semua', 'PengajuanController@daftarsayasemua')->name('pengajuan/daftarsaya/semua');
Route::get('/pengajuan/daftarsaya/edit/{id}', 'PengajuanController@daftarsayaedit')->name('pengajuan/daftarsaya/edit');
Route::post('/pengajuan/daftarsaya/update/{id}', 'PengajuanController@daftarsayaupdate')->name('pengajuan/daftarsaya/update');
	//user daftar semua
Route::get('/pengajuan/daftarsemua/hariini', 'PengajuanController@daftarsemuahariini')->name('pengajuan/daftarsemua/hariini');
Route::get('/pengajuan/daftarsemua/bulanini', 'PengajuanController@daftarsemuabulanini')->name('pengajuan/daftarsemua/bulanini');
Route::get('/pengajuan/daftarsemua/tahunini', 'PengajuanController@daftarsemuatahunini')->name('pengajuan/daftarsemua/tahunini');
Route::get('/pengajuan/daftarsemua/semua', 'PengajuanController@daftarsemua')->name('pengajuan/daftarsemua/semua');



//profil
Route::get('/profile', 'ProfileController@index')->name('profile');
Route::get('/profile/create', 'ProfileController@create')->name('profile/create');
Route::post('/profile/store', 'ProfileController@store')->name('profile/store');
Route::post('/profile/simpanvideo', 'ProfileController@simpanvideo')->name('profile/simpanvideo');
// Route::get('/profile/edit/{id}', 'ProfileController@edit')->name('profile/edit');
Route::get('/profile/edit', 'ProfileController@edit')->name('profile/edit');
Route::get('/profile/edit/video/{id}', 'ProfileController@editvideo')->name('profile/edit/video');
Route::post('/profile/update/video/{id}', 'ProfileController@updatevideo')->name('profile/update/video');
Route::get('/profile/delete/video/{id}', 'ProfileController@destroy')->name('profile/delete/video');
Route::post('/profile/update/{id}', 'ProfileController@update')->name('profile/update');

//filter pengajuan
Route::get('/pengajuan/semua', 'PengajuanController@pengajuansemua')->name('pengajuan/semua');
Route::get('/pengajuan/hariini', 'PengajuanController@pengajuanhariini')->name('pengajuan/hariini');
Route::get('/pengajuan/bulanini', 'PengajuanController@pengajuanbulanini')->name('pengajuan/bulanini');
Route::get('/pengajuan/tahunini', 'PengajuanController@pengajuantahunini')->name('pengajuan/tahunini');

//user
Route::get('/user', 'UserController@index')->name('user');
Route::get('/user/create', 'UserController@create')->name('user/create');
Route::post('/user/store', 'UserController@store')->name('user/store');
Route::get('/user/edit/{id}', 'UserController@edit')->name('user/edit');
Route::post('/user/update/{id}', 'UserController@update')->name('user/update');
Route::get('/user/delete/{id}', 'UserController@destroy')->name('user/delete');
Route::get('/user/reset/{id}', 'UserController@reset')->name('user/reset');

// Route::post('/simpan_user', 'UserController@store')->name('simpan_user');