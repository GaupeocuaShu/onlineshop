<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\FlashSellItem;
use App\Models\Product;
use App\Models\Slider;
use App\Models\SubCategory;
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
        return view("frontend.pages.home",
        compact("sliders","categoryBanners","categories","hotCategories","brands"
        ,"topProducts","newProducts","flashSellProducts"));
    }
    // return product page 
    // {product?}/{type?}/{subcategory?}/{category?}/{brand?}/{vendor?}
    public function product(Request $request){ 
   
        $allCategories = Category::with("subCategories")->get();
        $subCategory = null;
        $activeSub = null;
        if($request->type) $type = $request->type ;
        else $type = "featured";
        if($request->subcategory) {
            $subCategory = SubCategory::where("slug",$request->subcategory)->first(); 
            $activeSub = $subCategory->slug;
        };
        $category = Category::where("slug",$request->category)->first();
        $brands = Brand::with("categories")->whereHas("categories",function($query) use ($category){
            $query->where("categories.id",$category->id);
        })->get();
   
        $products = Product::where([
                ["category_id",$category->id],
                ["product_type",$type]
            ])
            ->where(function($query) use ($subCategory){ 
                if($subCategory) $query->where("sub_category_id",$subCategory->id);
            })
            ->get();
        return view("frontend.pages.category",[
            "categories" => $allCategories,
            "category" => $category,
            "products" => $products,
            "activeType" => $type,
            "activeSub" =>  $activeSub,
            "slug" => $category->slug,
            "brands" => $brands,
        ]);
    }
}
