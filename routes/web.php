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
Route::get('/admin','AdminController@index');
Route::get('/admin/projetos/adicionar','AdminController@addProjeto');
Route::post('/admin/projetos/guardar','AdminController@guardarProjeto');
Route::get('/admin/projeto/{id}/delete', 'AdminController@deleteprojeto');
Route::get('/admin/projeto/{id}/edit', 'AdminController@editprojeto');
Route::get('/admin/projeto/{id}/changehead', 'AdminController@changefoto');
Route::post('/admin/projeto/{id}/update', 'AdminController@updateprojeto');
Route::get('/admin/contactos/{id}/show', 'AdminController@mostrarcontacto');
Route::get('/admin/contactos/{id}/delete', 'AdminController@deletecontacto');
Route::post('/contacto/enviar', 'ProjetoController@enviarmensagem');
Route::get('projetos/{id}','ProjetoController@show');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
