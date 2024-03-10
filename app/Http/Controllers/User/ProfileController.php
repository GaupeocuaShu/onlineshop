<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class ProfileController extends Controller
{
    use UploadTrait;
    public function index(){
        $title = "Profile";
        $user = Auth::user();
        return view("frontend.home.pages.profile",compact("title","user"));
    }

    public function updateProfile(Request $request){
        $user = Auth::user();
     
        if($request->image) {
            $request->validate([
                "image" => ["image"],
            ]);
            $image = $this->updateImage($request,$user->image,"uploads","image");
            $user->update([
                "image" => $image,
            ]);
        }
        else{
      
            $request->validate([
                "username" => ["required"], 
                "name" => ["required"], 
                "email" => ["required","unique:users,email,".$user->id],
                "phone" => ["required"],
            ]);
            $user->update([
                "username" => $request->username,
                "email" => $request->email, 
                "phone" => $request->phone, 
                "name" => $request->name,
            ]);
        }; 
        return redirect()->back();
    }
}
