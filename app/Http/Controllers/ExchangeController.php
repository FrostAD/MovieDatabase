<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExchangeRequest;
use App\Models\Exchange;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExchangeController extends Controller
{
    public function index(){
        $exchanges = Exchange::where('visible',1)->paginate(4);
        return view('index.exchanges',compact('exchanges'));
    }

    public function index_specific($id){
        $exchanges = Exchange::where('visible',1)->where('movie1_id',$id)->paginate(4);
        return view('index.exchanges',compact('exchanges'));

    }

    public function show(Exchange $exchange)
    {
        return view('view.exchange', compact('exchange'));
    }

    public function create_view()
    {
        return view('create.exchange_create');
    }

    public function create(ExchangeRequest $request)
    {
        $user_id = Auth::user()->id;
        $exchange = new Exchange();
        $exchange->user1_id = $user_id;
        $exchange->movie1_id = $request->movie1_id;
        $exchange->visible = true;
        $exchange->save();
        return redirect()->back()->with('success','Exchange created successfully.');
    }

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

    public function accept(Request $request)
    {
        $exchange = Exchange::find($request->exchange_id);
        if ($request->movie_id == $exchange->first_movie->id) {
            return redirect()->back()->with('error','Can\'t choose the same movie');
        }
        $movie = Movie::find($request->movie_id);
        $exchange->user2_id = Auth::user()->id;
        $exchange->movie2_id = $movie->id;
        $exchange->return1 = false;
        $exchange->return2 = false;
        $exchange->visible = false;
        $exchange->save();
        return redirect()->back()->with('success','Exchange is successful!');
    }

    public function cancel(Request $request)
    {
        $exchange = Exchange::find($request->exchange_id);
        $exchange->delete();
        return redirect('/exchanges');
    }

    public function ret(Request $request)
    {
        $exchange = Exchange::find($request->exchange_id);
        if ($exchange->first_user->id == Auth::user()->id) {
            $exchange->return1 = true;
        } else {
            $exchange->return2 = true;
        }
        $exchange->save();
        return redirect()->back();

    }

    public function rate(Request $request)
    {
        $exchange = Exchange::find($request->exchange_id);
        if ($request->num == 2) {
            $exchange->rating_for_second = $request->star;
            $exchange->save();
            $this->save_avg_user_rating($exchange->second_user->id);

        } else {
            $exchange->rating_for_first = $request->star;
            $exchange->save();
            $this->save_avg_user_rating($exchange->first_user->id);
        }

        return redirect()->back();
    }

    public function save_avg_user_rating($user_id)
    {
        $user = User::find($user_id);
        $exchanges1 = Exchange::where('user1_id', $user_id)->get();
        $exchanges2 = Exchange::where('user2_id', $user_id)->get();
        $count_of_ratings = 0;
        $sum = 0;
        foreach ($exchanges1 as $exchange) {
            if ($exchange->rating_for_first != 0) {
                $count_of_ratings++;
                $sum += $exchange->rating_for_first;
            }
        }
        foreach ($exchanges2 as $exchange) {
            if ($exchange->rating_for_second != 0) {
                $count_of_ratings++;
                $sum += $exchange->rating_for_second;
            }
        }
        $new_rating = $sum / $count_of_ratings;
        $user->rating_exchange = $new_rating;

        if ($user->rating_post > 0){
            $user->rating_overall = ($user->rating_post + $user->rating_exchange) / 2;
        }else{
            $user->rating_overall = $user->rating_exchange;
        }

        $user->save();
    }
}
