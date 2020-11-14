<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMovie;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function upload_view()
    {
        return view('addMovie');
    }
    public function upload(StoreMovie $request)
    {
        // dd($request->all());
        // dd($request['poster']);
        $input = $request->all();
        $gen = $input['genres'];
        $input['genres'] = implode(',', $gen);
        $filename = $request->poster->getClientOriginalName();
        // dd($filename);
        $input['poster'] = $filename;
        $request->poster->storeAs('images', $filename, 'public');
        // dd($input);
        Movie::create($input);

        return redirect()->back()->with('message', 'Movie added successfully.');
    }
    public function showMovie(Movie $movie)
    {
        // dd($movie);
        return view('movie', compact('movie'));
    }
}
