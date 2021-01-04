<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Genre;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class MovieController extends Controller
{

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

    public function index(Request $request)
    {
//        dd($request->sortType);
        if ($request->sortType) {
            $sort = $request->sortType;
            $movies = Movie::orderBy($sort)->paginate(6)->withQueryString();
            return view('index.movies_only', compact('movies'))->render();
        }
        $movies = Movie::orderBy('created_at')->paginate(6);
        $movies->appends(['sort' => 'created_at']);
        return view('index.movies', compact('movies'));
    }

    public function show(Movie $movie)
    {
        // dd($movie->averageRating);
//        $genres = $movie->genres();
        $user = User::find($movie->user_id)->name;
        // dd($movie->trailer);
        $url = MovieController::getYoutubeEmbedUrl($movie->trailer);

        $comments = $movie->comments()->paginate(2);
//        $actors = $movie->actors();
        // $rating = $movie->averageRating;

        // $post = Movie::find($movie->id);

        // Add a rating of 3, or change the user's existing rating _to_ 3.
        // $post->rateOnce(3);
        // dd(Movie::find($movie->id)->ratings);
        if (Auth::user() == null) {
            $post = null;
        } else {
//            dd(Auth::user()->id);
            $post = Post::where('movie_id', $movie->id)->where('user_id', Auth::user()->id);
            $post = $post->first();
        }

        if ($post == null) {
            $post = new Post();
        } else {

//            dd($post);
        }
//        dd($movie->title);
//        dd(Event::first()->movie);
        $events = Event::whereHas('movie', function($q) use ($movie) {
            $q->where('title',$movie->title);
        });
        //TODO fix pagination jquerry in master layout is blocking this and redirects it
        $events = $events->simplePaginate(4);
//        dd($events);
        return view('view.movie2', compact('movie', 'user', 'url', 'comments', 'post','events'));
    }

    public function fetch(Request $request)
    {
        if ($request->ajax()) {
            $movie = Movie::find($request->movie);
            $comments = $movie->comments()->paginate(2);
            return view('partials.custom_replies', compact('comments'))->render();
        }
    }

    public function fetchMovies(Request $request)
    {
        if ($request->ajax()) {
//            dd($request->get('sort'));
            $sort = $request->get('sort');
            switch ($sort) {
                case 'title':
                    $movies = Movie::orderBy('title')->paginate(6);
                    break;
                case 'published':
                    $movies = Movie::orderBy('published')->paginate(6);
                    break;
                case 'rating':
                    $movies = Movie::orderBy('rating')->paginate(6);
                    break;
                default:
                    $movies = Movie::orderBy('created_at')->paginate(6);
                    break;
            }
        }
        return view('index.movies_only', compact('movies'))->render();
    }

    public
    function sort(Request $request)
    {
        //TODO make selected type default
        //TODO change some global var for sortType and use index() after that
        // $movies = Movie::orderBy($request['sort'])->paginate(3);
        // $movies = Movie::paginate(3);
        // dd($movies);
        // return view('index.movies', compact('movies'));
        // MovieController::index($request->sort);
        $sort = $request->sort;
        redirect('\movies', compact('sort'));
    }

    public
    function rate(Request $request)
    {

        $movie = Movie::find($request->movie_id);
        $movie->rateOnce($request->star);
        $movie['rating'] = $movie->averageRating;
        $movie->save();
        return back();
        // dd($request->movie_id);
    }

    public function ratePost(Request $request)
    {
        //TODO fix multiple voting on the same user from one movie pass the old value and search for it then update it with the new
        $movie = Movie::find($request->movie_id);
        $user_id = Auth::user()->id;
        $rating = $request->star;

        $post = Post::where('movie_id', $movie->id)->where('user_id', $user_id);
        $post = $post->first();
        if ($post == null) {
            $post = new Post();
            $post->movie_id = $movie->id;
            $post->user_id = $user_id;
            $post->rating = $rating;
        } else {
//            $post = $post->first();
            $post->rating = $rating;
        }


        $post->save();

        //Update author rating_post and rating_overall
        $author = $movie->user;
        $sum_all = 0;
        $count_all = 0;
        $sum = 0;
        $count = 0;
//        dd($author->movies);
        foreach ($author->movies as $movie_db) {
            $posts_db = Post::where('movie_id', $movie_db->id)->get();
//            echo $movie_db->id . " , ";
            if ($posts_db != null) {
                foreach ($posts_db as $post_db) {
                    if ($post_db != null) {
                        $sum += $post_db->rating;
                        $count++;
                    }
                }
                if ($count > 0) {
//                    echo 'Movie-' . $movie_db->id . " overall-" . $sum/$count . " || ";
                    $sum_all += $sum / $count;
                    $count_all++;
                    $sum = 0;
                    $count = 0;
                }
            }
        }
//        echo "Sum=".$sum_all." count=".$count_all;
//        dd("end");
        $overall = $sum_all / $count_all;
        $author->rating_post = $overall;
        if ($author->rating_exchange > 0) {
            $author->rating_overall = ($author->rating_post + $author->rating_exchange) / 2;
        } else {
            $author->rating_overall = $author->rating_post;
        }
        $author->save();


        return back();
    }

    function getYoutubeEmbedUrl($url)
    {
        if (strpos($url, 'embed')) {
            return $url;
        }
        $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_]+)\??/i';
        $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))(\w+)/i';
        $youtube_id = '';

        if (preg_match($longUrlRegex, $url, $matches)) {
            $youtube_id = $matches[count($matches) - 1];
        }

        if (preg_match($shortUrlRegex, $url, $matches)) {
            $youtube_id = $matches[count($matches) - 1];
        }
        return 'https://www.youtube.com/embed/' . $youtube_id;
    }


}
