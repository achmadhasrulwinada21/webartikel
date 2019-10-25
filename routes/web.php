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

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->group(function () {
       Route::resource('/artikel','ArtikelController');
       Route::resource('kategori','KategoriController');
       Route::resource('/manajemenuser','ManajemenuserController');        
});

Route::prefix('manajemenuser')->group(function () {
      Route::get('/json','ManajemenuserController@json'); 
      Route::post('/insert','ManajemenuserController@insert');
      Route::put('/edit/{id}', 'ManajemenuserController@edit');
      Route::post('/update','ManajemenuserController@update');
      ROUTE::DELETE('/destroy/{id}', 'ManajemenuserController@destroy');
      });

Route::prefix('kategori')->group(function () {
      Route::get('/json','KategoriController@json'); 
      Route::post('/store','KategoriController@store');
      ROUTE::DELETE('/destroy/{id}', 'KategoriController@destroy');
      Route::put('/edit/{id}', 'KategoriController@edit');
     });

Route::prefix('artikel')->group(function () {
      Route::get('/json','ArtikelController@json'); 
      Route::get('/tambah','ArtikelController@tambah');
      Route::post('/insert','ArtikelController@insert');
      Route::get('/edit/{id}','ArtikelController@edit');
      Route::put('/update/{id}', 'ArtikelController@update');
      ROUTE::DELETE('/hapus/{id}', 'ArtikelController@delete');
     });



