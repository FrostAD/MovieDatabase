<?php

namespace App\Http\Controllers;

use App\Models\Exchange;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
//    public function getOverallRating(User $user)
//    {
////        $user = User::find($user_id);
//        $ratings = collect();
//        foreach ($user->movies as $movie){
//            $ratings->push($movie->rating);
//            echo $movie->rating . ' ';
//        }
//        $rating_posts = $ratings->avg();
//        $result = ($rating_posts + $user->rating_exchange) / 2;
//        dd($result);
////            echo $movie->rating . ' ';
////        dd($user->movies->rating);
//    }
    public function upload(Request $request)
    {
        if ($request->hasFile('image')) {
            $filename = $request->image->hashName();
            $request->image->storeAs('avatars', $filename, 'public');
            User::find(Auth::id())->update(['avatar' => $filename]);
        }
//        dd($request->image->hashName());
        //TODO return msg for success
        return redirect()->back();
    }

    public function details($id)
    {
        $user = User::find($id);
        if (!$user) {
            $user = User::withTrashed()->find($id);
        }
        if (!$user)
            return redirect('/');


        $wishlist = $user->wishlist()->simplePaginate(5);
        $watchlist = $user->watchlist()->simplePaginate(5);

        $posts = $user->movies()->simplePaginate(5);

        $exchanges = Exchange::where('user1_id', Auth::id())->orWhere('user2_id', Auth::id())->get();
//        dd($exchanges);


        return view('view.user', compact('user', 'wishlist', 'watchlist', 'posts', 'exchanges'));
    }

    public function settings(User $user)
    {
//        dd($user);
        if ($user->id != Auth::user()->id) {
            //TODO return msg
            return redirect('/movies');
        }
        return view('create.account_settings', compact('user'));
    }

    public function update(User $user)
    {
//        dd(request('password') == null);
        if ($user->id == Auth::id()) {
            if (Auth::user()->email == request('email') && request('password') == null) {//Change name only

                $this->validate(request(), [
                    'name' => 'required',
                    //  'email' => 'required|email|unique:users',
//                    'password' => 'required|min:6|confirmed'
                ]);
//            dd(request());

//            dd($user);
                $user->name = request('name');
                // $user->email = request('email');
//                $user->password = bcrypt(request('password'));

                $user->save();

                return back();

            } elseif (Auth::user()->name == request('name') && request('password') == null) {//Change email only
                $this->validate(request(), [
//                'name' => 'required',
                    'email' => 'required|email|unique:users',
//                    'password' => 'required|min:6|confirmed'
                ]);
//            dd(request());


//            $user->name = request('name');
                $user->email = request('email');
//                $user->password = bcrypt(request('password'));

                $user->save();

                return back();
            } elseif (Auth::user()->email != request('email') && Auth::user()->name != request('name') && request('password') == null) {
                $this->validate(request(), [
                    'name' => 'required',
                    'email' => 'required|email|unique:users',
//                    'password' => 'required|min:6|confirmed'
                ]);

                $user->name = request('name');
                $user->email = request('email');
//                $user->password = bcrypt(request('password'));

                $user->save();
                return back();
            } else {
                $this->validate(request(), [
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore(Auth::user())],
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
                ]);

//        dd(request());

                $user->name = request('name');
                $user->email = request('email');
                $user->password = bcrypt(request('password'));

                $user->save();

                return back();
            }
        }
        return redirect('/');
    }
}
