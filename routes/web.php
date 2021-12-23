<?php

use Illuminate\Support\Facades\Route;



Route::get('site-bakimda',function(){
    return view('front.ofline');
});
/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
|
*/
Route::prefix('admin')->name('admin.')->middleware('isLogin')->group(function(){
Route::get('giris', 'Back\AuthController@login')->name('login');
Route::post('giris','Back\AuthController@loginPost')->name('login.post');

});
Route::prefix('admin')->name('admin.')->middleware('isAdmin')->group(function(){
    Route::get('panel', 'Back\Dashboard@index')->name('dashboard');

    //makale route
    Route::get('/makaleler/silinenler','Back\ArticleController@trashed')->name('trashed.article');
    Route::resource('makaleler', 'Back\ArticleController');
    Route::get('/switch','Back\ArticleController@switch')->name('switch');
    Route::get('/deletearticle/{id}','Back\ArticleController@delete')->name('delete.article');
    Route::get('/harddeletearticle/{id}','Back\ArticleController@harddelete')->name('harddelete.article');
    Route::get('/recoverarticle/{id}','Back\ArticleController@recover')->name('recover.article');

// kategori route
Route::get('/kategoriler','Back\CategoryController@index')->name('category.index');
Route::post('/kategoriler/create','Back\CategoryController@create')->name('category.create');
Route::post('/kategoriler/update','Back\CategoryController@update')->name('category.update');
Route::post('/kategoriler/delete','Back\CategoryController@delete')->name('category.delete');
Route::get('/kategori/status','Back\CategoryController@switch')->name('category.switch');
Route::get('/kategori/getData','Back\CategoryController@getData')->name('category.getData');

// SAYFA ROUTE
Route::get('/sayfalar','Back\PageController@index')->name('pages.index');
Route::get('/sayfalar/olustur','Back\PageController@create')->name('pages.create');
Route::get('/sayfalar/guncelle/{id}','Back\PageController@edit')->name('pages.edit');
Route::post('/sayfalar/guncelle/{id}','Back\PageController@update')->name('pages.edit.post');
Route::post('/sayfalar/olustur','Back\PageController@post')->name('pages.create.post');
Route::get('/sayfa/switch','Back\PageController@switch')->name('pages.switch');
Route::get('/sayfa/sil/{id}', 'Back\PageController@delete')->name('pages.delete');
Route::get('/sayfalar/siralama', 'Back\PageController@orders')->name('pages.orders');

// ayarlar route
Route::get('/ayarlar', 'Back\ConfigController@index')->name('config.index');
Route::post('/ayarlar/update', 'Back\ConfigController@update')->name('config.update');



//çıkış route
Route::get('cikis','Back\AuthController@logout')->name('logout');
});


/*
|--------------------------------------------------------------------------
| Front Routes
|--------------------------------------------------------------------------
|
*/




Route::get('/','Front\Homepage@index')->name('homepage');
Route::get('/kategori/{category}','Front\Homepage@category')->name('category');
Route::get('/iletisim','Front\Homepage@contact')->name('contact');
Route::post('/iletisim','Front\Homepage@contactpost')->name('contact.post');
Route::get('/{category}/{slug}','Front\Homepage@single')->name('single');
Route::get('/{sayfa}','Front\Homepage@page')->name('page');

