<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Comment;
use \App\Models\Movie;
use willvincent\Rateable\Tests\models\Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function store(Request $request)
    {
//        dd($request);
        $comment = new Comment;

        $comment->comment = $request->description;

        // dd($request->user());

        $comment->user()->associate(\Illuminate\Support\Facades\Auth::id());

        // dd($comment);


        $post = Movie::find($request->movie_id);

        $post->comments()->save($comment);

        return back();
    }

    public function replyStore(Request $request)
    {
        $reply = new Comment();

        $reply->comment = $request->get('comment');

        $reply->user()->associate($request->user());

        $reply->parent_id = $request->get('comment_id');

        $post = Movie::find($request->get('movie_id'));

        $post->comments()->save($reply);

        return back();
    }
}
