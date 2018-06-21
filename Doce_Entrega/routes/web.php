<?php


Route::get('/', function () {
    return view('admin.index');
})->middleware('auth');

Route::group(['prefix'=>'admin', 'namespace'=>'Admin', 'middleware' => 'auth'], function() {

   Route::resource('produtos', 'ProdutoController');
   Route::get('produtosgraf', 'ProdutoController@graf')
       ->name('produtos.graf');
    Route::resource('tipos', 'TipoController');
});

Auth::routes();

