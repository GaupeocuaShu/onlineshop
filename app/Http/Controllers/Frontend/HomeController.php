<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\FlashSellItem;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        $sliders = Slider::get()->sortBy("serial"); 
        $categoryBanners = Category::get()->take(6);  
        $categories = Category::with("subCategories")->get();
        $hotCategories = Category::get()->take(6);  
        $brands = Brand::get()->take(10); 
        $topProducts = Product::where("product_type","top")->where("is_approved",1)->get()->take(12);
        $newProducts = Product::where("product_type","new_arrival")->where("is_approved",1)->get()->take(12);
        $flashSellProducts = FlashSellItem::with("product")->get();
        return view("frontend.home.pages.home",
        compact("sliders","categoryBanners","categories","hotCategories","brands"
        ,"topProducts","newProducts","flashSellProducts"));
    }
}
