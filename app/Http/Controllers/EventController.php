<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index(Request $request)
    {
        if ($request->sortType) {
            $sort = $request->sortType;
            $events = Event::orderBy($sort)->paginate(3)->withQueryString();
            return view('index.events_only', compact('events'))->render();
        }
        $events = Event::orderBy('name')->paginate(3);
        $events->appends(['sort' => 'name']);
        return view('index.events', compact('events'));
    }

    public function fetchEvents(Request $request)
    {
        if ($request->ajax()) {
            $sort = $request->get('sort');
            switch ($sort) {
                case 'name':
                    $events = Event::orderBy('name')->paginate(3);
                    break;
                case 'capacity':
                    $events = Event::orderBy('capacity')->paginate(3);
                    break;
                default:
                    $events = Event::orderBy('date')->paginate(3);
                    break;
            }
        }
        return view('index.events_only', compact('events'))->render();
    }

    public function show(Event $event)
    {
        $movie = Movie::find($event->movie_id);
        return view('view.event', compact('event', 'movie'));
    }

    public function create_view()
    {
        return view('create.event_create');
    }

    public function create(Request $request)
    {
        $event = new Event();
        $event->name = $request->name;
        $event->user_id = Auth::user()->id;
        $event->date = $request->date;
        $event->capacity = $request->capacity;
        $event->current_cappacity = 1;
        $event->location = $request->location;
        $event->description = $request->description;
        $event->movie_id = $request->movie_id;

        $event->save();
        $event->users()->attach($event->user_id);
        return redirect('/events');
    }

    //using for event add page
    public function find(Request $request)
    {
        $movies = null;

        if ($request->has('q')) {
            $search = $request->q;
            $movies = Movie::select("id", "title")
                ->where('title', 'LIKE', "%$search%")
                ->get();
        }
        if ($movies == null) {
            $movies = Movie::all();
        }
        return response()->json($movies);
    }
    public function join(Request $request)
    {
        $event = Event::find($request->event_id);
        $user_id = Auth::user()->id;
        if($request->type == 'q'){
            $event->users()->detach($user_id);
            if (count($event->users) < 1){
                $event->delete();
                return redirect('/events');
            }
            else{
                $event->current_cappacity = $event->current_cappacity - 1;
                $event->save();
                return redirect()->back()->with('success','You left this event successfully!');
            }
        }else{
            $exist = $event->users->contains($user_id);
            if (!$exist) {

                $event->users()->attach($user_id);
                $event->current_cappacity = $event->current_cappacity + 1;
                $event->save();
                return redirect()->back()->with('success','You joined this event successfully!');

            }
        }
        return redirect()->back();
    }
    public function cancel(Request $request){
        $event = Event::find($request->event_id);
        if (Auth::id() == $event->user->id){
            $event->users()->detach();
            $event->delete();
//            $event->forceDelete();
        }

        return redirect('/events')->with('success','Event successfully canceled!');

    }
}
