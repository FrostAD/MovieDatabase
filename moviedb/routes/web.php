<?php

use App\Http\Controllers\ActorController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FestivalController;
use App\Http\Controllers\MovieController;
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
    dd(auth()->user()->movies);
})->middleware('auth');
Route::get('index', [MovieController::class, 'index']);
Route::get('/movies/add', [MovieController::class, 'upload_view']);
Route::post('/movies/add', [MovieController::class, 'upload']);
Route::get('movies/{movie:title}', [MovieController::class, 'showMovie']);
Route::get('/imbd', [MovieController::class, 'imbd']);

Route::get('festivals/add', [FestivalController::class, 'upload_view']);
Route::post('festivals/add', [FestivalController::class, 'upload']);

Route::get('/events/add', [EventController::class, 'upload_view']);
Route::post('/events/add', [EventController::class, 'upload']);

Route::get('/actors/add', [ActorController::class, 'upload_view']);
Route::post('actors/add', [ActorController::class, 'upload']);

Route::get('/test', [ActorController::class, 'test']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
