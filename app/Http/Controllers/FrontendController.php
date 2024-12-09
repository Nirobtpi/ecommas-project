<?php

namespace App\Http\Controllers;

use App\Models\Author\Author;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){
        $categories=Category::all();
        $posts=Post::where('status', 1)->paginate(3);
        $sliderPosts=Post::where('status',1)->latest()->take(3)->get();
        return view('frontend.index',compact('categories','posts','sliderPosts'));
       
    }
    public function author_login_page(){
        
        return view('frontend.author.login',);
       
    }
    public function author_signup_page(){
        
        return view('frontend.author.signup',);
       
    }
    public function post_datails($slug){
        $post=Post::where('slug',$slug)->first();
        $comments=Comment::where('post_id',$post->id)->orderBy('id','desc')->get();
        $count=Comment::where('post_id',$post->id)->count();
        $tags=explode(',',$post->tag_id);
        return view('frontend.post-details',compact('post','tags','comments','count'));
    }

    public function author_post($id){
        $author=Author::findOrFail($id);
        $posts=Post::where('author_id',$id)->where('status',1)->paginate(1);
        
        return view('frontend.author-post',compact('author','posts'));
    }
    public function category_post($id){
       $category=Category::findOrFail($id);
        $posts=Post::where('category_id',$id)->where('status',1)->paginate(1);
        
        return view('frontend.category_post',compact('posts','category'));
    }
}
