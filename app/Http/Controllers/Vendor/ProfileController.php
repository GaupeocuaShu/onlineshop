<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Chat;
use App\Models\User;

class ProfileController extends Controller
{
    use UploadTrait;
    public function index(){ 
       
        $user  = Auth::user(); 
        return view("vendor.profile.index",[ 
            "user" => $user, 
        ]);
    }
    // Update Profile
    public function profileUpdate(Request $request){
        $user = Auth::user();
        $request->validate([
            "image" => ["image"],
            "email" => ["unique:users,email,".$user->id],
        ]);
        $image = $this->updateImage($request,$user->image,"uploads","image");   
        $user->update([
            "image" => $image ? $image : $user->image,
            "name" => $request->name,
            "username" => $request->username,
            "email" => $request->email, 
            "phone" => $request->phone, 
        ]);
        Session::flash("status","Updated Profile");
        return redirect()->back();
    }

    // Update Password 
    public function passwordUpdate(Request $request){
        $user = Auth::user();
        $request->validate([
            "current_password" => ["required","current_password"], 
            "password" => [
                "required",
                "confirmed",
                "string",
                "min:8", 
                'regex:/^(?=.*[A-Z])(?=.*\d).+$/',
            ],  
        ]);
        $user->update(["password" =>bcrypt($request->password)]);
        Session::flash("status","Update Password Successfully");
        return redirect()->back();
    }    
}