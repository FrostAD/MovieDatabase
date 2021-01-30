<?php

namespace App\Http\Controllers;

use App\Models\Musician;
use Illuminate\Http\Request;

class MusicianController extends Controller
{

    /**
     * Display selected musician
     * @param Musician $musician
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Musician $musician)
    {
        $movies = $musician->movies()->simplePaginate(6);
        return view('view.musician', compact('musician','movies'));
    }

    /**
     * Gets all movies in which the selected musician is involved
     * @param Request $request
     * @return string
     */
    public function fetch(Request $request)
    {
        if ($request->ajax()) {
            $musician = Musician::find($request->musician);
            $movies = $musician->movies()->simplePaginate(6);
            //know all the fetch use the same view
            return view('view.actor_movies', compact('movies'))->render();
        }
    }
}
