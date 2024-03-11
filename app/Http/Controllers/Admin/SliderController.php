<?php

namespace App\Http\Controllers\admin;

use App\DataTables\SliderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class SliderController extends Controller
{
    use UploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(SliderDataTable $dataTable)
    {
        return $dataTable->render("admin.slider.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.slider.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "banner" => ["required","image"], 
            "serial" => ["required","numeric"], 
            "url" => ["nullable"], 
            "status" => ["required"],
        ]);
       
        if($request->banner) {
            $banner = $this->uploadImage($request,"uploads","banner");
        };

        
        Slider::create([
            "banner" => $banner, 
            "serial" => $request->serial,
            "status" => $request->status,
            "url" => $request->url,
        ]); 
        Session::flash("status","Create Slider Successfully"); 
        return redirect()->route("admin.slider.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // Change Status 
    public function changeStatus(){

    }
    
    // Change Serial 
    public function changeSerial(){
      
    }
}
