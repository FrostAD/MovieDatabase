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

    /**
     * Saves user comment in DB
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $comment = new Comment;
        $comment->comment = $request->description;

        $comment->user()->associate(\Illuminate\Support\Facades\Auth::id());

        $post = Movie::find($request->movie_id);

        $post->comments()->save($comment);

        return back();
    }

    /**
     * Save reply to another comment
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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
