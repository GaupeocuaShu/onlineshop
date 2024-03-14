<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        $sliders = Slider::get()->sortBy("serial"); 
        $categoryBanners = Category::get()->take(8);  

        return view("frontend.home.pages.home",compact("sliders","categoryBanners"));
    }
}
