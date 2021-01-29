<?php

namespace App\Http\Controllers;

use App\Models\Musician;
use Illuminate\Http\Request;

class MusicianController extends Controller
{
    public function show(Musician $musician)
    {
        $movies = $musician->movies()->simplePaginate(6);
        return view('view.musician', compact('musician','movies'));
    }
    public function fetch(Request $request)
    {
        if ($request->ajax()) {
            $musician = Musician::find($request->musician);
            $movies = $musician->movies()->simplePaginate(6);
            //TODO know all the fetch use the same view
            return view('view.actor_movies', compact('movies'))->render();
        }
    }
}
