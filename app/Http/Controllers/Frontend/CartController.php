<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cart;
use Darryldecode\Cart\Cart as CartCart;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;

class CartController extends Controller
{
    // Add to cart 
    public function addToCart(Request $request){  
        Cart::session(Auth::user()->id);
        $item = $request->except('temp_id','attributes');  
        $isShowInMiniCart =Cart::get($request->id) ? false : true ;
        Cart::add($item);
        $variants = explode(",",$request->input("attributes")[0]);
        Cart::update($item['id'],["attributes" =>  $variants]); 
        return response([
            "status" => 'success', 
            "message" => "Product was added to your cart", 
            "cart" => Cart::getTotalQuantity(),
            "price" =>  $request->price,  
            "variants" => $variants,
            "name" => $request->name,
            "isShowInMiniCart" => $isShowInMiniCart,
        ]);
    }
}
