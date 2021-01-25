<?php

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {    
    Route::get('/start', [AuthController::class, 'start'])->name("login");
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
    Route::get('/list', [AuthController::class, 'list']);
});

//🡩🡩🡩🡩🡩🡩🡩🡩🡩🡩🡩🡩🡩🡩🡩🡩🡩🡩🡩🡩🡩🡩🡩🡩🡩🡩🡩🡩🡩🡩🡩🡩🡩🡩🡩🡩🡩🡩🡩🡩🡩🡩🡩🡩🡩
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//:::::::::::::solo la parte de arriba se modificaron para autenticar :::::::::::
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

Route::get( 'cajera', 'Api\CajeraController@index');
Route::post('createCajera', 'Api\CajeraController@create');
Route::get('publicacion', 'Api\PublicacionController@index');
Route::get('ubicacion', 'Api\UbicacionController@index');
//aqui debes poner ruta ni tan completa del archivo @ metodo
//por defecto laravel tiene fijada la carpeta controller como la carpeta
// de controladores
//pones entre comilla
// y en la ruta agregas el subdirectorio
Route::get('categoria2/{id}', 'Api\CategoriaController@mostrar');


Route::post('publicacion', 'Api\PublicacionController@store');
Route::post('ubicacion', 'Api\UbicacionController@store');

Route::get('ubicacion/{nombre}', 'Api\UbicacionController@mostrar');
/*
Route::get('categoria2', function (Request $request) {
    $data = ['nombre'=>"Paul", "apellido"=>"Miranda"];
    return response()->json($data);
    // Este return es para devolver json
    //Pero debemos inportar el response
});
*/
//Por fin jejee ya tenemos la ruta que funciona todos las rutas que
//creas en este archivo cuando lo llames en el navegador debes poner
// api/   por delante no se que hice
