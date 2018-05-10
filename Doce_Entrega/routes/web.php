<?php


Route::get('/', function () {
    return view('admin.index');
});




Route::resource('usuarios','Admin\UsuariosController');

Route::resource('produtos','Admin\ProdutosController');
Auth::routes();