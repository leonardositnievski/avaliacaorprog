<?php

use App\Http\Controllers\FilmesController;
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


// Prefixo de rotas
// Todas as rotas aqui dentro vao ficar /filme/rota
Route::prefix('filme')->group(function(){
    Route::view('/inserir', 'filme.create')->name('upload'); // a função view serve pra quando eu não preciso de uma controller.
    Route::post('/inserir', [ FilmesController::class, 'store' ]);


    Route::get('/miniatura/{url}', [ FilmesController::class, 'foto' ])->name('foto');
    Route::get('/{id}', [FilmesController::class, 'show' ])->name('item');
    
    
});

Route::get('/', [ FilmesController::class, 'index' ])->name('home');

