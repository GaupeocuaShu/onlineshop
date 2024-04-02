<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use Carbon\Carbon;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class PaymentController extends Controller
{
    public function store(Request $request){ 
        Cart::session("checked"); 
        $cartConditions = Cart::getConditions();  
        $coupon = "";
        if(count($cartConditions) > 0 ){
            foreach($cartConditions as $con){
                $coupon .= $con->getName();
            }
        }
        $current = Carbon::now(); 
        $invoice_id = Auth::user()->id;
        $invoice_id .= $current->isoFormat('YYMMDDkkmm');
        $order =  Order::create([
            'invoice_id' =>  $invoice_id, 
            'user_id' => Auth::user()->id, 
            'sub_total' => Cart::getSubTotal(),
            'total' => Cart::getTotal(),
            "product_qty"=> Cart::getTotalQuantity(), 
            "payment_method" => $request->payment_method,
            "payment_status"=> $request->payment_status,
            "user_address_id"=> $request->order_address,
            "coupon" =>  $coupon ,
            "order_status" => "pending", 
        ]); 
        foreach(Cart::getContent() as $item){  
            $variants = array();  
            $index = 0;
            foreach($item->attributes as $key => $attr){
                if($index > 3)  $variants[$key] = $attr;
                $index++;
            }
            OrderProduct::create([
                'order_id' =>  $order->id, 
                'product_id' => $item->attributes->product_id, 
                'vendor_id' => $item->attributes->vendor_id,
                'product_name' => $item->name, 
                "variants" => json_encode($variants), 
                "variant_total"=> $index-4, 
                "unit_price" => $item->price, 
                "qty" => $item->quantity, 
            ]);
        };  
        $ids = array(); 
        foreach(Cart::getContent() as $item){ 
            $ids[] = $item->id; 
        }
        Cart::clear();  
        
        Cart::session(Auth::user()->id);  
        foreach($ids as $id) {
            Cart::remove($id);
        };
        return view("frontend.pages.payment-success",[
            "title" => "Payment Success"
        ]);
    }
}
