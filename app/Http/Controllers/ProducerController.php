<?php

namespace App\Http\Controllers;

use App\Models\Producer;
use Illuminate\Http\Request;

class ProducerController extends Controller
{
    public function show(Producer $producer)
    {
        // $movies = $actor->movies;
        // // dd($movies);
        // foreach ($movies as $movie) {
        //     echo ($movie->title);
        // }
        $movies = $producer->movies()->simplePaginate(6);
        return view('view.producer', compact('producer','movies'));
    }
    public function fetch(Request $request)
    {
        if ($request->ajax()) {
            $producer = Producer::find($request->producer);
            $movies = $producer->movies()->simplePaginate(6);
            //TODO know all the fetch use the same view
            return view('view.actor_movies', compact('movies'))->render();
        }
    }
}
