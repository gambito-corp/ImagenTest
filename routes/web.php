<?php

use App\Imagen;
use Illuminate\Support\Facades\Route;

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
    $imagenes = Imagen::all();
    return view('welcome', compact('imagenes'));
})->name('index');

Route::resource('imagen', 'ImagenController');
Route::get('imagen/route/{id}', 'ImagenController@getImagen')->name('getImagen');
