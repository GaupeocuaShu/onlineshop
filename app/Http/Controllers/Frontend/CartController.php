<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Facades\Auth;
class CartController extends Controller
{
    // Add to cart 
    public function addToCart(Request $request){  
        $item = $request->except('temp_id');
        Cart::session(Auth::user()->id)->add($item);
        return response([
            "status" => 'success', 
            "message" => "Product was added to your cart", 
            "cart" => Cart::getTotalQuantity(), 
        ]);
    }
}
