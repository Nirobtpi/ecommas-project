<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordRequest;
use App\Models\Author\Author;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Unique;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class UserController extends Controller
{
    public function editProfile(){
       
        return view('admin.user.edit-profile');
    }

    public function User(){
         $users=User::all();
        return view('admin.user.users',compact('users'));
    }

    public function userDelete($id){

        $user=User::findOrFail($id);

         if($user->photo != ''){
            $delete_photo=public_path('uploads/user/'. $user->photo);
            unlink($delete_photo);
        }


       User::findOrFail($id)->delete();
       return back()->with('success','User Deleted Successfully');

    }

    public function updateProfile(Request $request, $id){
        $userData=User::findOrFail($id);
        $request->validate([
            'name'=>['required'],
        ]);

        $userData->update([
            'name'=>$request->name,
        ]);
        return redirect()->back()->with('success','Profile Updated');
    }

    public function updatePassword(PasswordRequest $request, $id){
        $userPassword=User::findOrFail($id);
        if(Hash::check($request->old_password, Auth::user()->password)){
            $userPassword->update([
                'password'=>Hash::make($request->password),
            ]);
              return back()->with('pass','Password Update Successfully');
        }else{
            return back()->with('error','Old Password Does Not Match');
        }
        
    }

    public function update_photo(Request $request ,$id){
        $update_photo=User::findOrFail($id);
       

        $request->validate([
            'photo'=>['required','mimes:jpg,bmp,png','max:2048'],
        ]);

        if(Auth::user()->photo !=''){
            $delete_photo=public_path('uploads/user/'. Auth::user()->photo);
            unlink($delete_photo);
        }

        $photo= $request->photo;
        $extention=$photo->extension();
        $file_name= rand(1111,9999) .'.'. $extention;

        // create image manager with desired driver
        $manager = new ImageManager(new Driver());

        // read image from file system
        $image = $manager->read($photo);
        // image resize 
        $image->resize(200,150);
        $image->save(public_path('uploads/user/'.$file_name));

        $update_photo->update([
            'photo'=>$file_name,
        ]);

        return back()->with('photo','Photo update successfully');
    }


    public function addUser(Request $request){
        // return $request->all();
        $request->validate([
            'name'=>['required'],
            'email'=>['required','unique:users,email'],
            'password'=>['required','min:8','confirmed'],
            
        ]);
        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);
        return back()->with('add_user','User Added Successfully');
    }
    function author_list_page(){
        $authors=Author::all();
        
        return view('admin.user.author', compact('authors'));
    }
    function author_status($id){
        $author=Author::findOrFail($id);
        if($author->status == 0){
            $author->update([
                'status'=>'1',
            ]);
        }else{
            $author->update([
                'status'=>'0',
            ]);
        }
        return back()->with('status','Author Status Updated');
    }
    function author_delete($id){
        Author::findOrFail($id)->delete();
         return back()->with('delete','Author Deleted Successfully!');
    }
}
