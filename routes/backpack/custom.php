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
        // ['role:Admin'] //forbid all tabs in admin
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('actor', 'ActorCrudController');
    Route::crud('event', 'EventCrudController');
    Route::crud('festival', 'FestivalCrudController');
    Route::crud('genre', 'GenreCrudController');
    Route::crud('movie', 'MovieCrudController');
    Route::crud('musician', 'MusicianCrudController');
    Route::crud('producer', 'ProducerCrudController');
    Route::crud('screenwritter', 'ScreenwritterCrudController');
    Route::crud('studio', 'StudioCrudController');
    Route::crud('user', 'UserCrudController');
}); // this should be the absolute last line of this file