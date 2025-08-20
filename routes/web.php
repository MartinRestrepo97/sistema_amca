<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaginaController;
use App\Http\Controllers\AnimalesController;
use App\Http\Controllers\VegetalesController;
use App\Http\Controllers\PreparadosController;
use App\Http\Controllers\AgricultoresController;
use App\Http\Controllers\FincaController;
use App\Http\Controllers\ListadosController;

Auth::routes();

// RUTAS PÁGINA WEB
Route::get('/pagina_home', [PaginaController::class, 'index'])->name('pagina_home');
Route::get('/pagina_resultados/{texto_busqueda}', [PaginaController::class, 'resultados'])->name('pagina_resultados');
Route::post('/pagina_resultados', [PaginaController::class, 'resultados'])->name('pagina_resultados');
Route::get('/pagina_detalle/{id}/{tipo}', [PaginaController::class, 'detalles'])->name('pagina_detalle');

// RUTAS ADMINISTRADOR
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/animales', [AnimalesController::class, 'index'])->name('animales');
Route::post('/guardar_animal', [AnimalesController::class, 'guardar'])->name('guardar_animal');
Route::post('/animal_eliminar', [AnimalesController::class, 'eliminar'])->name('animal_eliminar');

Route::get('/vegetales', [VegetalesController::class, 'index'])->name('vegetales');
Route::post('/vegetales_guardar', [VegetalesController::class, 'guardar'])->name('vegetales_guardar');
Route::post('/vegetales_eliminar', [VegetalesController::class, 'eliminar'])->name('vegetales_eliminar');

Route::get('/preparados', [PreparadosController::class, 'index'])->name('preparados');
Route::post('/preparados_guardar', [PreparadosController::class, 'guardar'])->name('preparados_guardar');
Route::post('/preparados_eliminar', [PreparadosController::class, 'eliminar'])->name('preparados_eliminar');

Route::get('/agricultores', [AgricultoresController::class, 'index'])->name('agricultores');
Route::post('/agricultores_guardar', [AgricultoresController::class, 'guardar'])->name('agricultores_guardar');
Route::post('/agricultores_eliminar', [AgricultoresController::class, 'eliminar'])->name('agricultores_eliminar');

Route::get('/finca', [FincaController::class, 'index'])->name('finca');
Route::post('/finca_guardar', [FincaController::class, 'guardar'])->name('finca_guardar');
Route::post('/finca_eliminar', [FincaController::class, 'eliminar'])->name('finca_eliminar');

Route::get('/listados', [ListadosController::class, 'index'])->name('listados');

Route::get('/fincas_agricultor/{id_agricultor}', [AgricultoresController::class, 'get_agricultor_fincas'])->name('fincas_agricultor');
Route::post('/fincas_agricultor_guardar', [AgricultoresController::class, 'fincas_agricultor_guardar'])->name('fincas_agricultor_guardar');
Route::post('/fincas_agricultor_eliminar', [AgricultoresController::class, 'fincas_agricultor_eliminar'])->name('fincas_agricultor_eliminar');

Route::get('/animales_agricultor/{id_agricultor}', [AgricultoresController::class, 'get_agricultor_animales'])->name('animales_agricultor');
Route::post('/animales_agricultor_guardar', [AgricultoresController::class, 'animales_agricultor_guardar'])->name('animales_agricultor_guardar');
Route::post('/animales_agricultor_eliminar', [AgricultoresController::class, 'animales_agricultor_eliminar'])->name('animales_agricultor_eliminar');

Route::get('/vegetales_agricultor/{id_agricultor}', [AgricultoresController::class, 'get_agricultor_vegetales'])->name('vegetales_agricultor');
Route::post('/vegetales_agricultor_guardar', [AgricultoresController::class, 'vegetales_agricultor_guardar'])->name('vegetales_agricultor_guardar');
Route::post('/vegetales_agricultor_eliminar', [AgricultoresController::class, 'vegetales_agricultor_eliminar'])->name('vegetales_agricultor_eliminar');

Route::get('/preparados_agricultor/{id_agricultor}', [AgricultoresController::class, 'get_agricultor_preparados'])->name('preparados_agricultor');
Route::post('/preparados_agricultor_guardar', [AgricultoresController::class, 'preparados_agricultor_guardar'])->name('preparados_agricultor_guardar');
Route::post('/preparados_agricultor_eliminar', [AgricultoresController::class, 'preparados_agricultor_eliminar'])->name('preparados_agricultor_eliminar');

