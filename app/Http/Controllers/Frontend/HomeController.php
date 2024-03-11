<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        $sliders = Slider::get();
        return view("frontend.home.pages.home",compact("sliders"));
    }
}
