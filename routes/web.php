<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MoviesController as AppMoviesController;
use App\Http\Controllers\ActorController as AppActorController;
use App\Http\Controllers\TvController as AppTvController;

Route::get('/',[AppMoviesController::class,'index'])->name('movies.index');
Route::get('/movies/{id}',[AppMoviesController::class,'show'])->name('movies.show');

Route::get('/actors',[AppActorController::class,'index'])->name('actors.index');
Route::get('/actors/page/{page?}',[AppActorController::class,'index']);
Route::get('/actors/{id}',[AppActorController::class,'show'])->name('actors.show');


Route::get('/tv',[AppTvController::class,'index'])->name('tv.index');
Route::get('/tv/{id}',[AppTvController::class,'show'])->name('tv.show');
