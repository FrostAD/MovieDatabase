<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreActor;
use App\Models\Actor;
use App\Models\Movie;

class ActorController extends Controller
{
    public function upload_view()
    {
        return view('addPages.addActor');
    }
    public function upload(StoreActor $request)
    {
        $actor = $request->all();
        $actor['name'] = $actor['first_name'] . " " . $actor['last_name'];
        // $actor['movie_id'] = 3; works
        Actor::create($actor);
        return redirect()->back()->with('message', 'Actor added successfully');
    }
    public function test()
    {
        //$actor = Actor::find(2);
        // dd($actor);
        //$movie = Movie::find(2);
        //$actor->movies()->save($movie);
        //TODO add many to many
        $movies = Actor::find(2)->movies;
        echo $movies;
        // foreach ($movies as $movie) {
        //     echo nl2br($movie);
        // }
        // $actor['movie_id'] = 2;
        // Actor::create($actor);
        // echo "Done";
    }
}
