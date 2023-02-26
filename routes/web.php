<?php

use App\Http\Controllers\FavoritesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\SeriesController;
use App\Http\Livewire\Favorites;
use Illuminate\Support\Facades\Auth;

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
Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/favorites', Favorites::class)->name('favorites.index');
});
Route::get('/', [MoviesController::class,'index'])->name('welcome');
Route::get('/movies', [MoviesController::class,'index'])->name('movies.index');
Route::get('/movie/{movie}',[MoviesController::class,'show'])->name('movies.show');
Route::get('/series', [SeriesController::class,'index'])->name('series.index');
Route::get('/series/{serie}',[SeriesController::class,'show'])->name('series.show');


