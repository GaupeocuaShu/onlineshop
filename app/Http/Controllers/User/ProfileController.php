<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(){
        $title = "Profile";
        return view("frontend.home.pages.profile",compact("title"));
    }
}
