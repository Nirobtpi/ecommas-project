<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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
}
