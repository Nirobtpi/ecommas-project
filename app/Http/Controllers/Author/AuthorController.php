<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\Author\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthorController extends Controller
{
    public function author_register(Request $request){
        $request->validate([
            'name'=>['required'],
            'email'=>['required','unique:authors,email'],
            'password'=>['required','confirmed','min:8'],
        ]);
        Author::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);
        return back()->with('author_register','Registration Success! Your account is pending for Approval, you witt get confirmation mail when your account will active');
    }

    public function author_login(Request $request){
        $request->validate([
            'email'=>['required'],
            'password'=>['required'],
        ]);
   

        if(Author::where('email',$request->email)->exists()){
            if(Auth::guard('author')->attempt(['email' => $request->email, 'password' => $request->password])){
                return redirect('/');
            }else{
                  return back()->with('wrong','Email Or Password Does Not Exist!'); 
            }
        
        }else{
            return back()->with('user_err','Email Does Not Exist!');
        }
    }
    public function author_logout(){
        Auth::guard('author')->logout();
        return redirect('/');
    }
}
