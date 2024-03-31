<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
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
        Order::create([
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
        return view("frontend.pages.payment-success");
    }
}
