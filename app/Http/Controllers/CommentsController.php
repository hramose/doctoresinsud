<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\CommentFormRequest;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function newComment(CommentFormRequest $request)
    {
        $comment = new Comment(array(
                'post_id' => $request->get('post_id'),
                'content' => $request->get('content'),
                'post_type' => $request->get('post_type'),
        ));

        $comment->save();

        return redirect()->back()->with('status', 'Your comment has been created!');
    }
}