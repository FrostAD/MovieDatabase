<?php

namespace App\Http\Controllers;

use App\Models\Exchange;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    /**
     * Changes user profile picture
     * Save it in DB
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function upload(Request $request)
    {
        if ($request->hasFile('image')) {
            $filename = $request->image->hashName();
            $request->image->storeAs('avatars', $filename, 'public');
            User::find(Auth::id())->update(['avatar' => $filename]);
            return redirect()->back()->with('success','Profile picture changed!');

        }
        return redirect()->back()->with('error','Choose image!');
    }

    /**
     * Display selected user with its watchlist,wishlist,posts and exchanges
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
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


        return view('view.user', compact('user', 'wishlist', 'watchlist', 'posts', 'exchanges'));
    }

    /**
     * Display user settings page
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function settings(User $user)
    {
        if ($user->id != Auth::user()->id) {
            //Random user can't access
            return redirect('/movies');
        }
        return view('create.account_settings', compact('user'));
    }

    /**
     * Saves new changes(after validation) in user - name,email or password
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(User $user)
    {
        if ($user->id == Auth::id()) {
            if (Auth::user()->email == request('email') && request('password') == null) {//Change name only

                $this->validate(request(), [
                    'name' => 'required',
                    //  'email' => 'required|email|unique:users',
//                    'password' => 'required|min:6|confirmed'
                ]);
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


//            $user->name = request('name');
                $user->email = request('email');
//                $user->password = bcrypt(request('password'));

                $user->save();

                return back();
            } elseif (Auth::user()->email != request('email') && Auth::user()->name != request('name') && request('password') == null) {//Change name and email
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
            } else {//Change all
                $this->validate(request(), [
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore(Auth::user())],
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
                ]);

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
