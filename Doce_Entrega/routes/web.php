<?php


Route::get('/', function () {
    return view('admin.index');
})->middleware('auth');

Route::group(['prefix'=>'admin', 'namespace'=>'Admin', 'middleware' => 'auth'], function() {

   Route::resource('produtos', 'ProdutoController');
});

Auth::routes();

