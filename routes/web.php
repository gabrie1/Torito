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
//use App\Model\Categoria;
Route::get('/', function () {
    return view('welcome');
});

//Route:: get("/leer",'CategoriaController@index');
/**/
//Route::get('gmaps', 'MapController@gmaps');
Route::get('gmaps', 'MapController@gmaps');

Route::post('rutas',
array ('as'=>'rutas',
'uses'=>'MapController@rutas')
);


//R
