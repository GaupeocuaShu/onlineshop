<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cart; 
use App\Models\ShopProfile;
use App\Models\UserAddresses;
use Illuminate\Support\Facades\Auth;
class CheckOutController extends Controller
{
    public function index(){  
        $title = "Checkout";
        Cart::session("checked"); 
        $userID = Auth::user()->id; 
        $vendors = array(); 
        foreach(Cart::getContent() as $item){  
            $vendors[] = ShopProfile::findOrFail($item->attributes['vendor_id'])->toArray();
        } 
        $vendorsCollection = collect($vendors); 
        $uniqueVendorsCollection = $vendorsCollection->unique("id");
        $uniqueVendorsArray =   $uniqueVendorsCollection->toArray();   
        $address = UserAddresses::where([
            ["user_id" ,Auth::user()->id], 
            ["is_default",true] , 
            ])->first();
        $addresses = UserAddresses::where('user_id',Auth::user()->id)->get();
        return view("frontend.pages.check-out",[
            'vendors' => $uniqueVendorsArray , 
            'totalQuantity' => Cart::getTotalQuantity(),
            'title' => $title, 
            'address' => $address,
            'addresses' =>  $addresses,
        ]);
    }
}
