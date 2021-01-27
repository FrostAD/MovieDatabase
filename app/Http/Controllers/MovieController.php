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
//    public function restore(Request $request){
//        $movie = Movie::withTrashed()->find($request->id);
////        dd($movie);
//        $movie->restore();
//        return redirect()->back();
//    }

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
                return redirect('/movies');
            }
        }
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
        $events = Event::whereHas('movie', function ($q) use ($movie) {
            $q->where('title', $movie->title);
        });
        //TODO fix pagination jquerry in master layout is blocking this and redirects it
        $events = $events->simplePaginate(4);

        $recommended = new Collection();
        foreach ($movie->watchlist_users as $user) {
//            array_push($recommended, $user->watchlist);
            foreach ($user->watchlist as $m) {
                $recommended->add($m);
//                            array_push($recommended, $m);

//                foreach ($m->genres as $g) {
//                    if ($movie->genres->contains($g)) {
//                        if (!in_array($g, $recommended))
//                            array_push($recommended, $m);
//                    }
//                }
            }
        }
        $recommended = $recommended->unique()->except([$movie->id]);
        $exchanges = Exchange::where('visible',1)->where('movie1_id',$movie->id)->count();
//        dd($recommended);
//        $recommended = collect($recommended);
//        dd($recommended->unique());
//        dd($events);
        return view('view.movie2', compact('movie', 'user', 'url', 'comments', 'post', 'events','recommended','exchanges'));
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

    public function watchlist_add(Request $request)
    {
        $movie = Movie::find($request->movie_id);
        $user = User::find(\auth()->user()->id);
        $user->watchlist()->attach($movie);
        return redirect()->back();
//        dd($user->watchlist);
    }

    public function watchlist_remove(Request $request)
    {
        $movie = Movie::find($request->movie_id);
        $user = User::find(\auth()->user()->id);
        $user->watchlist()->detach($movie);
        return redirect()->back();

//        dd($user->watchlist);
    }

    public function wishlist_add(Request $request)
    {
        $movie = Movie::find($request->movie_id);
        $user = User::find(\auth()->user()->id);
        $user->wishlist()->attach($movie);
        return redirect()->back();
//        dd($user->watchlist);
    }

    public function wishlist_remove(Request $request)
    {
        $movie = Movie::find($request->movie_id);
        $user = User::find(\auth()->user()->id);
        $user->wishlist()->detach($movie);
        return redirect()->back();

//        dd($user->watchlist);
    }
}
