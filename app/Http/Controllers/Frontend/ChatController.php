<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\ShopProfile;
use App\Models\User;
use Illuminate\Support\Facades\Auth; 
class ChatController extends Controller
{
    public function index(){
          
        return view("frontend.pages.chat",[
         
        ]);
    }

}
