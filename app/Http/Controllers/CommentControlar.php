<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentControlar extends Controller
{
    public function comment(Request $request){
        $request->validate([
            'name'=>['required'],
            'email'=>['required'],
            'message'=>['required'],
        ]);
      
             Comment::create([
            'post_id'=>$request->post_id,
            'author_name'=>$request->name,
            'email'=>$request->email,
            'comment_body'=>$request->message,
        ]);
        return back()->with('comment_success',' Your message was sent successfully.');
    }

    
}
