<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SexoController;
use App\Http\Controllers\IdiomaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\AutorController;
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

Auth::routes();

Route::get('/sexos/index', [App\Http\Controllers\SexoController::class, 'index'])->name('sexos.index');

//Route::get('/sexos/index', [SexoController::class, 'index'])->name('sexos.index');;

Route::resource('sexos',SexoController::class);
Route::resource('idiomas',IdiomaController::class);
Route::resource('categorias',CategoriaController::class);
Route::resource('autores',AutorController::class)->parameters([
    'autores'=>'autor'
]);
