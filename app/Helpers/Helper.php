<?php
// Set active for admin navbar

use App\Models\Chat;
use App\Models\ShopProfile;
use App\Models\User;

function setActive(array $routes)
{
    foreach ($routes as $route) {
        if (request()->routeIs($route))
            return "active";
    }
};

// Check table is Empty 
function isTableEmpty($model){
    return $model->isEmpty();
}
 
// Check sale 

function checkSale($product)
{
    $currentDate = Date("Y-m-d");
    if (
        $product->offer_price > 0 && $currentDate >= $product->offer_start_price
        && $currentDate <=  $product->offer_end_price
    ) return true;
    else return false;
}

// Calculate Sale

function calculateSalePercent($product)
{
    $discountPrice = $product->price - $product->offer_price;
    $percent =  ($discountPrice / $product->price) * 100;
    return number_format($percent,0);
}

// Get Product type
function getProductType($product)
{
    $type = "";
    switch ($product->product_type) {
        case 'top':
            $type = "TOP";
            break;
        case 'best':
            $type = "BEST";
            break;
        case 'featured':
            $type = "FEATURED";
            break;
        case 'new_arrival':
            $type = "NEW";
            break;
        default:
            $type = null;
            break;
    }
    return $type;
}


function getAllType(){
    return ["featured" => "Featured","best" => "Best","top" => "Top","new" => "New Arrival"];
}

// Chat -------------------------------------
function getReceivers() : array{
    $receivers = array();
    $id = auth()->user()->id;
    $receiverIDs = Chat::where("sender_id", $id)->groupBy('receiver_id')->pluck('receiver_id')->toArray();
    if( auth()->user()->role == 'user'){
        foreach($receiverIDs as $id) {
            $receivers[] = ShopProfile::where("user_id",$id)->first();
        };
    }
    else {
        foreach($receiverIDs as $id) {
            $receivers[] = User::findOrFail($id);
        };
    }
    return $receivers;

}


// Chat -------------------------------------
