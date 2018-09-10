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

/*listado de tipo de documentos :D*/
Route::get('tipo-documentos/index',
    'TipoDocumentoController@index')
    ->name('tipo-documentos.index');

/*muestra el formulario de creacion*/
Route::get('tipo-documentos/create',
        'TipoDocumentoController@create')
        ->name('tipo-documentos.create');

/*guardar el registro*/
Route::post('tipo-documentos/store', 'TipoDocumentoController@store')->name('tipo-documentos.store');

Route::post('tipo-documentos/buscar',
            'TipoDocumentoController@buscar')
        ->name('tipo-documentos.buscar');

Route::get('tipo-documentos/edit/{id}',
            'TipoDocumentoController@edit')
        ->name('tipo-documentos.edit');

Route::put('tipo-documentos/update/{id}',
            'TipoDocumentoController@update')
        ->name('tipo-documentos.update');

Route::delete('tipo-documentos/destroy/{id}',
            'TipoDocumentoController@destroy')
        ->name('tipo-documentos.destroy');

Route::resource('documentos', 'DocumentoController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
