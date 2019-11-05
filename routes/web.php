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
       Route::resource('/banner','Master\BannerController');  
       Route::resource('/produk','Master\ProdukController');  
       Route::resource('/servis','Master\ServisController');
       Route::resource('/testimoni','Master\TestimoniController');
       Route::resource('/footerbrand','Master\FooterbrandController'); 
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
      Route::get('/perusahaan','Setup\SettingwebController@perusahaan'); 
      Route::post('/update','Setup\SettingwebController@update');
      Route::post('/update2','Setup\SettingwebController@update2');
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

  Route::prefix('banner')->group(function () {
      Route::get('/json','Master\BannerController@json'); 
      Route::get('/tambah','Master\BannerController@tambah');
      Route::post('/insert','Master\BannerController@insert');
      Route::get('/edit/{id}','Master\BannerController@edit');
      Route::put('/update/{id}', 'Master\BannerController@update');
      ROUTE::DELETE('/hapus/{id}', 'Master\BannerController@delete');
      });
  Route::prefix('produk')->group(function () {
      Route::get('/json','Master\ProdukController@json'); 
      Route::get('/tambah','Master\ProdukController@tambah');
      Route::post('/insert','Master\ProdukController@insert');
      Route::get('/edit/{id}','Master\ProdukController@edit');
      Route::put('/update/{id}', 'Master\ProdukController@update');
      ROUTE::DELETE('/hapus/{id}', 'Master\ProdukController@delete');
      });
Route::prefix('servis')->group(function () {
      Route::get('/json','Master\ServisController@json'); 
      Route::get('/tambah','Master\ServisController@tambah');
      Route::post('/insert','Master\ServisController@insert');
      Route::get('/edit/{id}','Master\ServisController@edit');
      Route::put('/update/{id}', 'Master\ServisController@update');
      ROUTE::DELETE('/hapus/{id}', 'Master\ServisController@delete');
      });
Route::prefix('testimoni')->group(function () {
      Route::get('/json','Master\TestimoniController@json'); 
      Route::get('/tambah','Master\TestimoniController@tambah');
      Route::post('/insert','Master\TestimoniController@insert');
      Route::get('/edit/{id}','Master\TestimoniController@edit');
      Route::put('/update/{id}', 'Master\TestimoniController@update');
      ROUTE::DELETE('/hapus/{id}', 'Master\TestimoniController@delete');
      });
Route::prefix('footerbrand')->group(function () {
      Route::get('/json','Master\FooterbrandController@json'); 
      Route::get('/tambah','Master\FooterbrandController@tambah');
      Route::post('/insert','Master\FooterbrandController@insert');
      Route::get('/edit/{id}','Master\FooterbrandController@edit');
      Route::put('/update/{id}', 'Master\FooterbrandController@update');
      ROUTE::DELETE('/hapus/{id}', 'Master\FooterbrandController@delete');
      });


