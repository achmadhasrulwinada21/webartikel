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
       Route::resource('/artikel','Artikel\ArtikelController');
       Route::resource('kategori','Artikel\KategoriController');
       Route::resource('/manajemenuser','Setup\ManajemenuserController'); 
       Route::resource('/settingweb','Setup\SettingwebController'); 
       Route::resource('/menu','Setup\MenuController');  
       Route::resource('/judul','Setup\JudulController');    
   });

Route::prefix('manajemenuser')->group(function () {
      Route::get('/json','Setup\ManajemenuserController@json'); 
      Route::post('/insert','Setup\ManajemenuserController@insert');
      Route::put('/edit/{id}', 'Setup\ManajemenuserController@edit');
      Route::post('/update','Setup\ManajemenuserController@update');
      Route::post('/update2','Setup\ManajemenuserController@update2');
      ROUTE::DELETE('/destroy/{id}', 'Setup\ManajemenuserController@destroy');
      });

Route::prefix('kategori')->group(function () {
      Route::get('/json','Artikel\KategoriController@json'); 
      Route::post('/store','Artikel\KategoriController@store');
      ROUTE::DELETE('/destroy/{id}', 'Artikel\KategoriController@destroy');
      Route::put('/edit/{id}', 'Artikel\KategoriController@edit');
     });

Route::prefix('artikel')->group(function () {
      Route::get('/json','Artikel\ArtikelController@json'); 
      Route::get('/tambah','Artikel\ArtikelController@tambah');
      Route::post('/insert','Artikel\ArtikelController@insert');
      Route::get('/edit/{id}','Artikel\ArtikelController@edit');
      Route::put('/update/{id}', 'Artikel\ArtikelController@update');
      ROUTE::DELETE('/hapus/{id}', 'Artikel\ArtikelController@delete');
      });

Route::prefix('settingweb')->group(function () {
      Route::get('/json','Setup\SettingwebController@json'); 
      Route::post('/update','Setup\SettingwebController@update');
       });

Route::prefix('menu')->group(function () {
      Route::get('/json','Setup\MenuController@json'); 
      Route::post('/insert','Setup\MenuController@insert');
      Route::put('/edit/{id}', 'Setup\MenuController@edit');
      ROUTE::DELETE('/destroy/{id}', 'Setup\MenuController@destroy');
 });

 Route::prefix('judul')->group(function () {
      Route::get('/json','Setup\JudulController@json'); 
      Route::post('/insert','Setup\JudulController@insert');
      Route::put('/edit/{id}', 'Setup\JudulController@edit');
      ROUTE::DELETE('/destroy/{id}', 'Setup\JudulController@destroy');
 });



