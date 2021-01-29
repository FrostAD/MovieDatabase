<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Exchange;
use App\Models\Genre;
use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{


    public function index(Request $request)
    {
        if ($request->sortType) {
            $sort = $request->sortType;
            $movies = Movie::orderBy($sort)->paginate(6)->withQueryString();
            return view('index.movies_only', compact('movies'))->render();
        }
        $movies = Movie::orderBy('created_at')->paginate(6);
        $movies->appends(['sort' => 'created_at']);
        return view('index.movies', compact('movies'));
    }

    public function show($id)
    {
        $movie = Movie::find($id);
        //trashed or not exist
        if (!$movie) {
            $movie = Movie::withTrashed()->find($id);
            if (!$movie)
                return redirect('/movies');
            else {
                if (\auth()->user()) {
                    if (\auth()->user()->hasRole('Admin')) {

                    } else {
                        return redirect('/movies');
                    }
                }
//                return redirect('/movies');
            }
        }
        $user = User::find($movie->user_id)->name;
        $url = MovieController::getYoutubeEmbedUrl($movie->trailer);

        $comments = $movie->comments()->paginate(2);
        if (Auth::user() == null) {
            $post = null;
        } else {
            $post = Post::where('movie_id', $movie->id)->where('user_id', Auth::user()->id);
            $post = $post->first();
        }

        if ($post == null) {
            $post = new Post();
        }
        $events = Event::whereHas('movie', function ($q) use ($movie) {
            $q->where('title', $movie->title);
        });
        $events = $events->simplePaginate(4);


        $recommended = new Collection();
        foreach ($movie->watchlist_users as $user) {
            foreach ($user->watchlist as $m) {
                $recommended->add($m);
            }
        }
        $recommended = $recommended->unique()->except([$movie->id]);
        $exchanges = Exchange::where('visible', 1)->where('movie1_id', $movie->id)->count();
        return view('view.movie2', compact('movie', 'user', 'url', 'comments', 'post', 'events', 'recommended', 'exchanges'));
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
    }

    public function ratePost(Request $request)
    {
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
            $post->rating = $rating;
        }


        $post->save();

        //Update author rating_post and rating_overall
        $author = $movie->user;
        $sum_all = 0;
        $count_all = 0;
        $sum = 0;
        $count = 0;
        foreach ($author->movies as $movie_db) {
            $posts_db = Post::where('movie_id', $movie_db->id)->get();
            if ($posts_db != null) {
                foreach ($posts_db as $post_db) {
                    if ($post_db != null) {
                        $sum += $post_db->rating;
                        $count++;
                    }
                }
                if ($count > 0) {
                    $sum_all += $sum / $count;
                    $count_all++;
                    $sum = 0;
                    $count = 0;
                }
            }
        }
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

    public function watchlist_add(Request $request)
    {
        $movie = Movie::find($request->movie_id);
        $user = User::find(\auth()->user()->id);
        $user->watchlist()->attach($movie);
        return redirect()->back();
    }

    public function watchlist_remove(Request $request)
    {
        $movie = Movie::find($request->movie_id);
        $user = User::find(\auth()->user()->id);
        $user->watchlist()->detach($movie);
        return redirect()->back();
    }

    public function wishlist_add(Request $request)
    {
        $movie = Movie::find($request->movie_id);
        $user = User::find(\auth()->user()->id);
        $user->wishlist()->attach($movie);
        return redirect()->back();
    }

    public function wishlist_remove(Request $request)
    {
        $movie = Movie::find($request->movie_id);
        $user = User::find(\auth()->user()->id);
        $user->wishlist()->detach($movie);
        return redirect()->back();
    }
}
