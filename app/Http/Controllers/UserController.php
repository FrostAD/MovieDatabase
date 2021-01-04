<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function details(User $user)
    {
        return view('view.user', compact('user'));
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
        if(Auth::user()->email == request('email')) {//Change name only

            $this->validate(request(), [
                'name' => 'required',
                //  'email' => 'required|email|unique:users',
                'password' => 'required|min:6|confirmed'
            ]);
//            dd(request());

//            dd($user);
            $user->name = request('name');
            // $user->email = request('email');
            $user->password = bcrypt(request('password'));

            $user->save();

            return back();

        }elseif(Auth::user()->name == request('name')){//Change email only
            $this->validate(request(), [
//                'name' => 'required',
                  'email' => 'required|email|unique:users',
                'password' => 'required|min:6|confirmed'
            ]);
//            dd(request());


//            $user->name = request('name');
             $user->email = request('email');
            $user->password = bcrypt(request('password'));

            $user->save();

            return back();
        }
        else{
        $this->validate(request(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

//        dd(request());

        $user->name = request('name');
        $user->email = request('email');
        $user->password = bcrypt(request('password'));

        $user->save();

        return back();}
    }
}
