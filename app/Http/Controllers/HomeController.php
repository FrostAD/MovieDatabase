<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function home()
    {
        $last_movie = Movie::orderBy('created_at')->get()->last();
        $movies_action = Movie::whereHas('genres', function($q){
            $q->where('name','Action');
        })->get();
        $movies_drama = Movie::whereHas('genres', function($q){
            $q->where('name','Drama');
        })->get();
//        dd($movies_action);

        return view('home2', compact('last_movie','movies_action','movies_drama'));
    }
}
