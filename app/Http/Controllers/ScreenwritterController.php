<?php

namespace App\Http\Controllers;

use App\Models\Screenwritter;
use Illuminate\Http\Request;

class ScreenwritterController extends Controller
{
    public function show(Screenwritter $screenwritter)
    {
        // $movies = $actor->movies;
        // // dd($movies);
        // foreach ($movies as $movie) {
        //     echo ($movie->title);
        // }
        $movies = $screenwritter->movies()->simplePaginate(2);
        return view('view.screenwritter', compact('screenwritter','movies'));
    }
    public function fetch(Request $request)
    {
        if ($request->ajax()) {
            $screenwritter = Screenwritter::find($request->screenwritter);
            $movies = $screenwritter->movies()->simplePaginate(2);
            //TODO know all the fetch use the same view
            return view('view.actor_movies', compact('movies'))->render();
        }
    }
}
