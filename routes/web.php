<?php


//Route::get('/', function () {
//    return view('admin.index');
//})->middleware('auth');

Route::get('/', function () {
    return view('site.principal');
});

Route::group(['prefix'=>'admin', 'namespace'=>'Admin', 'middleware' => 'auth'], function() {

   Route::resource('produtos', 'ProdutoController');
   Route::resource('inicio', 'InicioController');
    Route::post('produtospesq', 'ProdutoController@pesq')
       ->name('produtos.pesq');   
       //Route::post('produtosforpesq', 'ProdFornecedorController@pesq')
      // ->name('produtosfor.pesq'); 
   Route::get('produtosgraf', 'ProdutoController@graf')
       ->name('produtos.graf');
    Route::resource('tipos', 'TipoController');
    Route::resource('produtosfornecedores', 'ProdFornecedorController');
    
});
Route::group(['prefix'=>'fornecedor', 'namespace'=>'Fornecedores'], function() {

    Route::resource('tiposforn', 'TipoFornController');
    Route::resource('produtosforn', 'ProdutoFornController');
    Route::post('produtosfornpesq', 'ProdutoFornController@pesq')
    ->name('produtosforn.pesq'); 
  
    
});



Auth::routes();


