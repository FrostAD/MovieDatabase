<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreEvent;
use App\Models\Movie;
use App\Models\Event;

class EventController extends Controller
{
    public function upload_view()
    {
        return view('addPages.addEvent');
    }
    public function upload(StoreEvent $request)
    {
        $event = $request->all();
        $event['author_id'] = auth()->id();
        $movie = Movie::all()->firstWhere('title', $event['movie']);
        $event['movie_id'] = $movie->id;
        Event::create($event);

        return redirect()->back()->with('message', 'Event added successfully');
    }
}
