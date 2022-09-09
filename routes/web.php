<?php

use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\SeasonController;
use App\Http\Controllers\SeriesController;
use App\Http\Middleware\Autenticador;
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
    return redirect('/series');
})->middleware(Autenticador::class);

Route::controller(SeriesController::class)->group(function(){
    Route::get('/series', 'index')->name('series.index');
    Route::get('/series/criar', 'create')->name('series.create');
    Route::post('/series/salvar', 'store')->name('series.store');
    Route::delete('/series/destroy/{id}', 'destroy')->name('series.destroy');
    Route::get('/series/{series}/editar', 'edit')->name('series.edit');
    Route::put('/series/atualizar/{series}','update')->name('series.update');
});

Route::controller(SeasonController::class)->group(function(){
    Route::get('/series/{series}/seasons', 'index')->name('seasons.index');
});

Route::controller(EpisodeController::class)->group(function(){
    Route::get('/seasons/{season}/episodes', 'index')->name('episodes.index');
    Route::post('/seasons/{season}/episodes', 'update')->name('episodes.update');
});