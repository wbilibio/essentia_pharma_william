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

Route::get('/', ['uses' => 'ClientsController@index', 'as' => 'clients.index']);
Route::post('clients/sortable', ['uses' => 'ClientsController@sortable', 'as' => 'clients.sortable']);
Route::post('clients/store', ['uses' => 'ClientsController@store', 'as' => 'clients.store']);
Route::post('clients/{id}', ['uses' => 'ClientsController@update', 'as' => 'clients.{id}.update']);
Route::get('clients/{id}/remove', ['uses' => 'ClientsController@destroy', 'as' => 'clients.{id}.destroy']);
Route::get('clients/{id}/remove_image', ['uses' => 'ClientsController@destroyImage', 'as' => 'clients.{id}.remove_image']);
Route::get('clientes/{id}/editar', ['uses' => 'ClientsController@edit', 'as' => 'clients.{id}.edit']);