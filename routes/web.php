<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [IndexController::class, 'home'])->name('homepage');
Route::get('/danh-muc/{slug}', [IndexController::class, 'category'])->name('category');
Route::get('/the-loai/{slug}', [IndexController::class, 'genre'])->name('genre');
Route::get('/quoc-gia/{slug}', [IndexController::class, 'country'])->name('country');
Route::get('/phim/{slug}', [IndexController::class, 'movie'])->name('movie');
Route::get('/xem-phim/{slug}/{tap}', [IndexController::class, 'watch']);
Route::get('/tap-phim', [IndexController::class, 'episode'])->name('tap-phim');
Route::get('/nam/{year}', [IndexController::class, 'year'])->name('years');
Route::get('/search', [IndexController::class, 'search'])->name('search');
Route::get('/filter', [IndexController::class, 'filter'])->name('filter');
Route::post('/add-rating', [IndexController::class, 'add_rating']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/home/statistical/date', [HomeController::class, 'date'])->name('date');
Route::get('/movie-views-by-date', [HomeController::class, 'get_date']);
Route::get('/movie-views-by-month', [HomeController::class, 'get_month']);
Route::get('/movie-views-by-year', [HomeController::class, 'get_year']);
Route::get('/home/statistical/month', [HomeController::class, 'month'])->name('month');
Route::get('/home/statistical/year', [HomeController::class, 'year'])->name('year');

/* 
| --------------------------------------------------------------------------
| admin route
| --------------------------------------------------------------------------
| Set up route for admin page
*/
// category
Route::resource('category', CategoryController::class);
// country
Route::resource('country',CountryController::class);
// genre
Route::resource('genre',GenreController::class);
// movie
Route::resource('movie',MovieController::class);
// episode
Route::resource('episode',EpisodeController::class);
// statistical

Route::get('/select-movie', [EpisodeController::class, 'select_movie'])->name('select-movie');
Route::get('episode/{id}/show', [EpisodeController::class, 'show'])->name('show');
Route::post('/increase-view/{id}', [IndexController::class, 'increase_view']);

