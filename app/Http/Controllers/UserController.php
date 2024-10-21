<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordRequest;
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

        if(Auth::user()->photo !==''){
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
}
