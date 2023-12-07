<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Reply;
use App\Models\User;
use Auth;

class CommentController extends Controller
{
    public function add_comment(request $request)
    {
        if(Auth::id())
        {
            $data = array(
                'name' => Auth::user()->name,
                'comment' => $request->comment,
                'user_id'=>  Auth::user()->id,
                
            );
            $comment = Comment::create($data);
            return redirect()->back();
        }
        else
        {
            return redirect()->route('login');
        }
    }
}
