<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function post(){
        $categories=Category::get();
        $tags=Tag::get();
        return view('frontend.author.post.add-post',compact('categories','tags'));
    }
}
