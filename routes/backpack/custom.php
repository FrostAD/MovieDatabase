<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin'),
//         ['role:Admin'] //forbid all tabs in admin
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('actor', 'ActorCrudController');
    Route::get('actor/{actor:id}/restore', [\App\Http\Controllers\Admin\ActorCrudController::class,'restore']);
    Route::get('actor/{actor:id}/hard_delete', [\App\Http\Controllers\Admin\ActorCrudController::class,'hard_delete']);

    Route::crud('event', 'EventCrudController');
    Route::crud('festival', 'FestivalCrudController');
    Route::crud('genre', 'GenreCrudController');
    Route::get('genre/{genre:id}/restore', [\App\Http\Controllers\Admin\GenreCrudController::class,'restore']);
    Route::get('genre/{genre:id}/hard_delete', [\App\Http\Controllers\Admin\GenreCrudController::class,'hard_delete']);
    Route::crud('movie', 'MovieCrudController');
    Route::get('movie/{movie:id}/restore', [\App\Http\Controllers\Admin\MovieCrudController::class,'restore'])->name('movie.restore');
    Route::get('movie/{movie:id}/hard_delete', [\App\Http\Controllers\Admin\MovieCrudController::class,'hard_delete']);

//    Route::get('/movie/{movie:id}/restore', 'MovieCrudController@restore');
    Route::crud('musician', 'MusicianCrudController');
    Route::crud('producer', 'ProducerCrudController');
    Route::crud('screenwritter', 'ScreenwritterCrudController');
    Route::crud('studio', 'StudioCrudController');
    Route::crud('user', 'UserCrudController');
    Route::delete('user/{user:id}/delete', [\App\Http\Controllers\Admin\UserCrudController::class,'delete']);
    Route::get('user/{user:id}/restore', [\App\Http\Controllers\Admin\UserCrudController::class,'restore']);
    Route::get('user/{user:id}/hard_delete', [\App\Http\Controllers\Admin\UserCrudController::class,'hard_delete']);
}); // this should be the absolute last line of this file
