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


Route::resource('painel/usuarios', 'Painel\\UserController');


Route::get('painel/home', function(){
    return view('painel.modulos.home');
});

Route::get('painel/list', function(){
    return view('painel.modulos.list');
});

Route::get('painel/form', function(){
    return view('painel.modulos.form');
})->name('painel.form');

Route::get('empresa', 'Site\\SiteController@empresa');
Route::get('contato', 'Site\\SiteController@contato');
Route::get('/', 'Site\\SiteController@index');


