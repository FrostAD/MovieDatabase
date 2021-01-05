<?php

use App\Http\Controllers\ExchangeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ActorController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FestivalController;
use App\Http\Controllers\MusicianController;
use App\Http\Controllers\ProducerController;
use App\Http\Controllers\ScreenwritterController;
use App\Http\Controllers\StudioController;
use App\Http\Controllers\UserController;
use App\Http\Requests\MovieRequest;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
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

Route::get('/',[MovieController::class,'home']);
// Route::get('/movie', [MovieController::class, 'show']);
//Route::get('/mvt', [MovieController::class, 'index_new'])->name('movieTable');
Route::get('/movies', [MovieController::class, 'index'])->name('fetch.movies.index');
Route::post('/movies', [MovieController::class, 'index'])->name('movieSort');
Route::post('/movies/fetch',[MovieController::class,'fetchMovies'])->name('fetch.movies');
Route::post('/movies/sort', [MovieController::class, 'sort']);

Route::get('/movie/{movie:id}', [MovieController::class, 'show'])->name('movie');
Route::post('/movie/rate/', [MovieController::class, 'rate'])->middleware('auth');
Route::post('/movie/rate/post',[MovieController::class, 'ratePost'])->middleware('auth');
Route::post('/movie/comments',[MovieController::class,'fetch'])->name('fetch.comments');

Route::get('/actor/{actor:id}', [ActorController::class, 'show'])->name('fetch.movies.actor.main');
Route::post('/actor/movies', [ActorController::class, 'fetch'])->name('fetch.movies.actor');

Route::get('/musician/{musician:id}', [MusicianController::class, 'show'])->name('fetch.movies.musician.main');
Route::post('/musician/movies', [MusicianController::class, 'fetch'])->name('fetch.movies.musician');

Route::get('/producer/{producer:id}', [ProducerController::class, 'show'])->name('fetch.movies.producer.main');
Route::post('/producer/movies', [ProducerController::class, 'fetch'])->name('fetch.movies.producer');

Route::get('/screenwritter/{screenwritter:id}', [ScreenwritterController::class, 'show'])->name('fetch.movies.screenwritter.main');
Route::post('/screenwritter/movies', [ScreenwritterController::class, 'fetch'])->name('fetch.movies.screenwritter');

Route::get('/festivals', [FestivalController::class, 'index'])->name('fetch.festivals.index');
Route::post('/festivals',[FestivalController::class,'index'])->name('festivalSort');
Route::post('/festivals/fetch',[FestivalController::class,'fetchFestivals'])->name('fetch.festivals');

Route::get('/festival/{festival:id}', [FestivalController::class, 'show']);

Route::get('/events',[EventController::class,'index'])->name('fetch.events.index');
Route::post('/events',[EventController::class,'index'])->name('eventSort');
Route::post('/events/fetch',[EventController::class,'fetchEvents'])->name('fetch.events');

//TODO add post route for sorting the index like movies
Route::get('/event/create',[EventController::class,'create_view'])->name('event.create')->middleware('auth');
Route::get('/event/create/fetch',[EventController::class,'find'])->name('event.fetch.movies');
Route::post('/event/create/save',[EventController::class,'create']);
Route::get('/event/{event:id}',[EventController::class,'show'])->name('fetch.event');
Route::post('/event/func',[EventController::class,'show'])->name('fetch.event.func');
Route::post('/event/join',[EventController::class,'join'])->name('event.join')->middleware('auth');
Route::post('/event/cancel',[EventController::class,'cancel'])->middleware('auth');

Route::get('/exchanges',[ExchangeController::class,'index'])->name('fetch.exchanges.index');
Route::get('/exchange/create',[ExchangeController::class,'create_view'])->name('exchange.create')->middleware('auth');
Route::get('/exchange/create/fetch',[ExchangeController::class,'find'])->name('exchange.fetch.movies');
Route::post('/exchange/create/save',[ExchangeController::class,'create']);
Route::get('/exchange/{exchange:id}',[ExchangeController::class,'show'])->name('exchange.accept');
Route::post('/exchange/accept/',[ExchangeController::class,'accept']);
Route::post('/exchange/cancel/',[ExchangeController::class,'cancel']);
Route::post('exchange/return',[ExchangeController::class,'ret']);
Route::post('/exchange/rate',[ExchangeController::class,'rate']);

Route::get('/overall/{user:id}',[UserController::class,'getOverallRating']);

Route::post('/comment/store', [CommentController::class, 'store'])->name('comment.add')->middleware('auth');
Route::post('/reply/store', [CommentController::class, 'replyStore'])->name('reply.add')->middleware('auth');

Auth::routes();

Route::get('/account/{user:id}',[UserController::class,'details']);
Route::get('/account/{user:id}/settings',[UserController::class,'settings'])->name('account.settings')->middleware('auth');
Route::post('account/update/{user:id}',[UserController::class,'update']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/fix',function (){
   File::deleteDirectory(public_path('storage'));
    Artisan::call('storage:link');
});

//TODO fix /admin and /dashboard and admin/login gives error(make redirect to /login)
//TODO fix /admin/* to be accessable only by admins
