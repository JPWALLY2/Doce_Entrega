<?php


//Route::get('/', function () {
//    return view('admin.index');
//})->middleware('auth');

Route::get('/', function () {
    return view('site.principal');
});
Route::get('fornecedores', ['middleware'=>'guest', function(){
    return view('fornecedores.principal');
}]);

Route::group(['prefix'=>'admin', 'namespace'=>'Admin', 'middleware' => 'auth'], function() {

   Route::resource('produtos', 'ProdutoController');
   Route::resource('inicio', 'InicioController');
   Route::resource('estoques', 'EstoqueController');
    Route::post('produtospesq', 'ProdutoController@pesq')
       ->name('produtos.pesq');   
   Route::get('produtosgraf', 'ProdutoController@graf')
       ->name('produtos.graf');
    Route::resource('tipos', 'TipoController');
    Route::post('gravaestoque', 'ProdutoController@gravaEstoque')
        ->name('grava.estoque');
});
Route::get('/produtows/{id}', 'Admin\ProdutoController@ws');
Route::get('/produtowsxml/{nome?}', 'Admin\ProdutoController@wsxml');

Auth::routes();


