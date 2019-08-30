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



/** Rotas Site */
Route::get('empresa', 'Site\\SiteController@empresa');
Route::get('contato', 'Site\\SiteController@contato');
Route::get('/', 'Site\\SiteController@index');





Route::get('admin', function(){
    return view('painel.modulos.home');
});



/****************************************************************************************
 * Rotas do Painel
****************************************************************************************/
Route::group(['prefix' => 'painel'], function (){
    
    //Usuários
    Route::any('/usuarios/pesquisar', 'Painel\UserController@search')->name('usuarios.search');
    Route::resource('/usuarios', 'Painel\UserController');
   //Categorias
   Route::any('/categorias/pesquisar', 'Painel\CategoriaController@search')->name('categorias.search');
   Route::resource('/categorias', 'Painel\CategoriaController');
   //Raiz painel
   Route::get('/', 'HomeController@index')->name('home');
});