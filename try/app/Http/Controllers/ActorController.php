<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actor;
use App\Models\Movie;

class ActorController extends Controller
{
    public function show(Actor $actor)
    {
        // $movies = $actor->movies;
        // // dd($movies);
        // foreach ($movies as $movie) {
        //     echo ($movie->title);
        // }
        $movies = $actor->movies()->simplePaginate(2);
        return view('view.actor', compact('actor','movies'));
    }
    public function fetch(Request $request)
    {
        if ($request->ajax()) {
            $actor = Actor::find($request->actor);
            $movies = $actor->movies()->simplePaginate(2);
            return view('view.actor_movies', compact('movies'))->render();
        }
    }
}
