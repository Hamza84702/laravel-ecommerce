<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use App\Models\Reply;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function add_reply(request $request)
    {
        if(Auth::id())
        {
            $data = array(
                'name' => Auth::user()->name,
                'comment_id' => $request->commentId,
                'user_id' =>  Auth::user()->id,
                'reply' => $request->reply,
                
            );
            $reply = Reply::create($data);
            return redirect()->back();
        }
        else
        {
            return redirect()->route('login');
        }
    }
}
