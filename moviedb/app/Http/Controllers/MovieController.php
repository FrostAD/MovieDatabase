<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMovie;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        //get all movies added by current user
        // $movies = auth()->user()->movies()->get();
        // return $movies;
        // return view('view.movie');
    }
    public function upload_view()
    {
        return view('addPages.addMovie');
    }
    public function upload(StoreMovie $request)
    {
        //TODO add actors list and add the movie in actors 'list'
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
        // add id
        // TODO remove picture file after delete of movie
        $input['author_id'] = auth()->id();
        //TODO fix timespan sum
        $input['timespan'] = $input['timespan_hours'] * 60 + $input['timespan_minutes'];
        // return dd($input);
        Movie::create($input);

        return redirect()->back()->with('message', 'Movie added successfully.');
    }
    public function showMovie(Movie $movie)
    {
        // dd($movie);
        // echo $movie->title;
        $rating = MovieController::findByTitle_imbd($movie->title);
        $author_name = User::find($movie->author_id)->name;
        // dd($author_name->name);
        // return $rating;
        return view('view.movie', compact('movie', 'rating', 'author_name'));
    }
    public function imbd()
    {
        return view('imbd');
    }
    public static function findByTitle_imbd($title)
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://imdb-internet-movie-database-unofficial.p.rapidapi.com/film/" . rawurlencode($title),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "x-rapidapi-host: imdb-internet-movie-database-unofficial.p.rapidapi.com",
                "x-rapidapi-key: e1e35729f3msh632c29a6ed8fce5p120306jsn15147069dd8b"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {

            $res = explode(",", $response);
            // dd($res);
            //TODO find if is possible to get awards
            $res = explode(":", $res[4]);
            $value = str_replace('"', "", $res[1]);
            return $value;
        }
    }
}
