<?php

use App\Http\Controllers\ExchangeController;
use App\Http\Controllers\HomeController;
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
use Illuminate\Support\Facades\Storage;

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

Route::get('/', [HomeController::class, 'home']);
//
Route::get('/search',[\App\Http\Controllers\SiteWideSearchController::class,'search_view']);
//
//Index movies
Route::get('/movies', [MovieController::class, 'index'])->name('fetch.movies.index');
Route::post('/movies', [MovieController::class, 'index'])->name('movieSort');
Route::post('/movies/fetch', [MovieController::class, 'fetchMovies'])->name('fetch.movies');
Route::post('/movies/sort', [MovieController::class, 'sort']);
//Movie view
Route::post('/movie/watchlist_add',[MovieController::class,'watchlist_add'])->middleware('auth');
Route::post('/movie/watchlist_remove',[MovieController::class,'watchlist_remove'])->middleware('auth');
Route::post('/movie/wishlist_add',[MovieController::class,'wishlist_add'])->middleware('auth');
Route::post('/movie/wishlist_remove',[MovieController::class,'wishlist_remove'])->middleware('auth');
Route::post('/movie/rate/', [MovieController::class, 'rate'])->middleware('auth');
Route::post('/movie/rate/post', [MovieController::class, 'ratePost'])->middleware('auth');
Route::post('/movie/comments', [MovieController::class, 'fetch'])->name('fetch.comments');
Route::get('/movie/{movie:id}', [MovieController::class, 'show'])->name('movie');
//Movie comments
Route::post('/comment/store', [CommentController::class, 'store'])->name('comment.add')->middleware('auth');
Route::post('/reply/store', [CommentController::class, 'replyStore'])->name('reply.add')->middleware('auth');
//Actor view
Route::get('/actor/{actor:id}', [ActorController::class, 'show'])->name('fetch.movies.actor.main');
Route::post('/actor/movies', [ActorController::class, 'fetch'])->name('fetch.movies.actor');
//Musician view
Route::get('/musician/{musician:id}', [MusicianController::class, 'show'])->name('fetch.movies.musician.main');
Route::post('/musician/movies', [MusicianController::class, 'fetch'])->name('fetch.movies.musician');
//Producer view
Route::get('/producer/{producer:id}', [ProducerController::class, 'show'])->name('fetch.movies.producer.main');
Route::post('/producer/movies', [ProducerController::class, 'fetch'])->name('fetch.movies.producer');
//Screenwriter
Route::get('/screenwritter/{screenwritter:id}', [ScreenwritterController::class, 'show'])->name('fetch.movies.screenwritter.main');
Route::post('/screenwritter/movies', [ScreenwritterController::class, 'fetch'])->name('fetch.movies.screenwritter');
//Index festivals
Route::get('/festivals', [FestivalController::class, 'index'])->name('fetch.festivals.index');
Route::post('/festivals', [FestivalController::class, 'index'])->name('festivalSort');
Route::post('/festivals/fetch', [FestivalController::class, 'fetchFestivals'])->name('fetch.festivals');
//Festival view
Route::get('/festival/{festival:id}', [FestivalController::class, 'show']);
//Index events
Route::get('/events', [EventController::class, 'index'])->name('fetch.events.index');
Route::post('/events', [EventController::class, 'index'])->name('eventSort');
Route::post('/events/fetch', [EventController::class, 'fetchEvents'])->name('fetch.events');
//Event operations and view
Route::get('/event/create', [EventController::class, 'create_view'])->name('event.create_custom')->middleware(['auth','verified']);
Route::get('/event/create/fetch', [EventController::class, 'find'])->name('event.fetch.movies')->middleware(['auth','verified']);
Route::post('/event/create/save', [EventController::class, 'create'])->middleware(['auth','verified']);
Route::get('/event/{event:id}', [EventController::class, 'show'])->name('fetch.event');
Route::post('/event/join', [EventController::class, 'join'])->name('event.join')->middleware(['auth','verified']);
Route::post('/event/cancel', [EventController::class, 'cancel'])->middleware(['auth','verified']);
//Index exchanges
Route::get('/exchanges', [ExchangeController::class, 'index'])->name('fetch.exchanges.index');
//Index exchanges(specific movie)
Route::get('/exchanges/{exchange:id}',[ExchangeController::class,'index_specific']);
//Exchange operations
Route::get('/exchange/create', [ExchangeController::class, 'create_view'])->name('exchange.create')->middleware(['auth','verified']);
Route::get('/exchange/create/fetch', [ExchangeController::class, 'find'])->name('exchange.fetch.movies')->middleware(['auth','verified']);
Route::post('/exchange/create/save', [ExchangeController::class, 'create'])->middleware(['auth','verified']);
Route::post('/exchange/accept/', [ExchangeController::class, 'accept'])->middleware(['auth','verified']);
Route::post('/exchange/cancel/', [ExchangeController::class, 'cancel'])->middleware(['auth','verified']);
Route::post('exchange/return', [ExchangeController::class, 'ret'])->middleware(['auth','verified']);
Route::post('/exchange/rate', [ExchangeController::class, 'rate'])->middleware(['auth','verified']);
//Exchange view
Route::get('/exchange/{exchange:id}', [ExchangeController::class, 'show'])->name('exchange.accept')->middleware(['auth','verified']);


Auth::routes(['verify' => true]);

Route::get('/account/{user:id}', [UserController::class, 'details'])->name('account');
Route::post('/account/upload',[UserController::class,'upload'])->middleware(['auth']);
Route::get('/account/{user:id}/settings', [UserController::class, 'settings'])->name('account.settings')->middleware('auth');
Route::post('account/update/{user:id}', [UserController::class, 'update'])->middleware('auth');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/fix', function () {
    Artisan::call('storage:link');
    return redirect('/');
});

//TODO fix /admin and /dashboard and admin/login gives error(make redirect to /login)
//TODO fix /admin/* to be accessable only by admins
