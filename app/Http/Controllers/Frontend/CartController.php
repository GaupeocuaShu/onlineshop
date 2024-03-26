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
        $vendorCounts = array();
        foreach(Cart::getContent() as $item){  
            $vendorCounts[] =  ShopProfile::select('id')->findOrFail($item->attributes['vendor_id'])->toArray();
            $vendors[] = ShopProfile::findOrFail($item->attributes['vendor_id'])->toArray();
        } 
 
        $vendorCountsID = array();
        foreach( $vendorCounts as $v) {
            $vendorCountsID[] = $v['id'];
        }
        $vendorsCollection = collect($vendors); 
        $uniqueVendorsCollection = $vendorsCollection->unique("id");
        $uniqueVendorsArray =   $uniqueVendorsCollection->toArray();
        return view("frontend.pages.cart",[
            'vendors' => $uniqueVendorsArray ,
            'vendorCountsID' => $vendorCountsID
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

    // Update Cart  
    public function update(Request $request){
        Cart::session(Auth::user()->id);
        Cart::update($request->id,['quantity' =>  array(
            'relative' => false,
            'value' => $request->quantity,
        )]);
        return response(['status' => "success"]);
    }
    public function get(Request $request){ 
        Cart::session(Auth::user()->id);
        if($request->type == "all") {  
            if($request->isCheck == 'true') {
                $quantity = Cart::getTotalQuantity();  
                $totalPrice = Cart::getTotal();
                return response([
                    "total" => $totalPrice, 
                    "quantity" => $quantity
                ]);
            }
            else {
                return response([
                    "total" => 0, 
                    "quantity" => 0,
                ]);
            }
        }
        else { 
            $sum = 0;  
            $quantity = 0 ;
            $idArray = json_decode($request->ids);
            foreach($idArray as $id) { 
                $sum += Cart::get($id)->getPriceSum();  
                $quantity += Cart::get($id)->quantity; 
            }
            return response([
                'total' => $sum, 
                "quantity" =>  $quantity, 
            ]);
        }    
    }
}
