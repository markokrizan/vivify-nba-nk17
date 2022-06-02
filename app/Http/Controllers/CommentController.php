<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Mail\CommentReceived;
use App\Models\Comment;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CommentController extends Controller
{
    public function store(Team $team, CommentRequest $commentRequest) {
        // This 
        // $comment = new Comment($commentRequest->validated());

        // $comment->team()->associate($comment);
        // $comment->user()->associate(Auth::user());

        // $comment->save();

        // Or this
        $data = array_merge(
            $commentRequest->validated(),
            [
                'user_id' => Auth::id()
            ]
        );

        $comment = $team->comments()->create($data);

        Mail::to($team->email)->send(new CommentReceived($comment));

        return back();
    }
}
