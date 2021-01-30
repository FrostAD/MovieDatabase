<?php

namespace App\Http\Controllers;

use App\Models\Producer;
use Illuminate\Http\Request;

class ProducerController extends Controller
{

    /**
     * Display selected producer
     * @param Producer $producer
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Producer $producer)
    {
        $movies = $producer->movies()->simplePaginate(6);
        return view('view.producer', compact('producer','movies'));
    }

    /**
     * Gets all movies in which the selected producer is involved
     * @param Request $request
     * @return string
     */
    public function fetch(Request $request)
    {
        if ($request->ajax()) {
            $producer = Producer::find($request->producer);
            $movies = $producer->movies()->simplePaginate(6);
            //know all the fetch use the same view
            return view('view.actor_movies', compact('movies'))->render();
        }
    }
}
