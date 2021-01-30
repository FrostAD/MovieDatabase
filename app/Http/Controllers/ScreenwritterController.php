<?php

namespace App\Http\Controllers;

use App\Models\Screenwritter;
use Illuminate\Http\Request;

class ScreenwritterController extends Controller
{

    /**
     * Display selected screenwriter
     * @param Screenwritter $screenwritter
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Screenwritter $screenwritter)
    {
        $movies = $screenwritter->movies()->simplePaginate(6);
        return view('view.screenwritter', compact('screenwritter','movies'));
    }

    /**
     * Gets all movies in which the selected screenwriter is involved
     * @param Request $request
     * @return string
     */
    public function fetch(Request $request)
    {
        if ($request->ajax()) {
            $screenwritter = Screenwritter::find($request->screenwritter);
            $movies = $screenwritter->movies()->simplePaginate(6);
            //know all the fetch use the same view
            return view('view.actor_movies', compact('movies'))->render();
        }
    }
}
