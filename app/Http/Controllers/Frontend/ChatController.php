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
        // Get Chat -----------------------------
        $shopID = ShopProfile::where("user_id",Auth::user()->id)->pluck('id')->toArray();
   
        $receiverIDs = Chat::where("sender_id",$shopID )
        ->groupBy("receiver_id")
        ->pluck('receiver_id')->toArray(); 

        $senderIDs = Chat::where("receiver_id",$shopID )
        ->groupBy("sender_id")
        ->pluck('sender_id')->toArray(); 
        
        $allReceiverids = array_unique(array_merge($receiverIDs,$senderIDs));
        $receivers = array();   
        foreach($allReceiverids as $receiverID){ 
            $receivers[] = User::findOrFail($receiverID);
        }
        // Get Chat -----------------------------             
        return view("frontend.pages.chat",[
            "receivers" =>$receivers,
        ]);
    }

}
