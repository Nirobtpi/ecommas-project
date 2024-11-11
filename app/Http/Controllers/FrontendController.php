<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){
        $categories=Category::all();
        return view('frontend.index',compact('categories'));
       
    }
    public function author_login_page(){
        
        return view('frontend.author.login',);
       
    }
    public function author_signup_page(){
        
        return view('frontend.author.signup',);
       
    }
}
