<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\ShopProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class UserMessageController extends Controller
{   

    public function sendMessage(Request $request){
        $senderID = $request->sender_id; 
        $receiverID = $request->receiver_id; 
        $isNewConversation =  count(Chat::whereIn('receiver_id',[ $senderID , $receiverID ])
        ->whereIn('sender_id',[ $senderID , $receiverID ])
        ->get()) <= 0 ? true :false ;


        Chat::create([
            "receiver_id" => $receiverID , 
            "sender_id" => $senderID , 
            "message" => $request->message_content, 
        ]); 
        
        return response([
            "status" => "success", 
            "receiver" => ShopProfile::findOrFail($request->receiver_id),
            "isNewConversation" =>$isNewConversation,
        ]);
    }
    public function getMessage(Request $request){
        $senderID = $request->sender_id; 
        $receiverID = $request->receiver_id; 

        $chat = Chat::whereIn('receiver_id',[ $senderID , $receiverID ])
                    ->whereIn('sender_id',[ $senderID , $receiverID ])
                    ->orderBy('created_at','asc')
                    ->get();
        return response([
            'status' => "success",
            "chat" => $chat
        ]);
    }
}
