<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cart;
use Darryldecode\Cart\Cart as CartCart;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\ShopProfile;

use function PHPUnit\Framework\isEmpty;

class CartController extends Controller
{
    // return cart view 
    public function index(){  
        $userID = Auth::user()->id; 
        Cart::session($userID); 
        $vendors = array(); 
        foreach(Cart::getContent() as $item){ 
            $vendors[] = ShopProfile::findOrFail($item->attributes['vendor_id'])->toArray();
        }
        return view("frontend.pages.cart",[
            'vendors' => $vendors
        ]);
    }


    // Add to cart 
    public function addToCart(Request $request){  
        $variants=array_merge(...json_decode($request->input("attributes"),true));
        Cart::session(Auth::user()->id);
        $item = $request->except('temp_id','attributes');  
        $isShowInMiniCart =Cart::get($request->id) ? false : true ;
        Cart::add($item); 
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
