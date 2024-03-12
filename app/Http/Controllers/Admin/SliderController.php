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
            "name" => ["required","string"],
            "banner" => ["required","image"], 
            "serial" => ["required","numeric"], 
            "url" => ["nullable"], 
            "status" => ["required"],
        ]);
       
        if($request->banner) {
            $banner = $this->uploadImage($request,"uploads","banner");
        };

        
        Slider::create([
            "name" => $request->name,
            "banner" => $banner, 
            "serial" => $request->serial,
            "status" => $request->status,
            "url" => $request->url,
        ]); 
        Session::flash("status","Create Slider Successfully"); 
        return redirect()->route("admin.slider.index");
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $slider = Slider::findOrFail($id); 
        return view("admin.slider.edit",compact("slider"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $slider = Slider::findOrFail($id); 
        $request->validate([
            "name" => ["required","string"],
            "banner" => ["image"], 
            "serial" => ["required","numeric"], 
            "url" => ["nullable"], 
            "status" => ["required"],
        ]);
        $banner = $this->updateImage($request,$slider->banner,"uploads","banner");
        $slider->update([
            "banner" => $banner ? $banner : $slider->banner, 
            "name" => $request->name, 
            "serial" => $request->serial, 
            "url" => $request->url, 
            "status" => $request->status, 
        ]) ; 
        Session::flash("status","Update Slider Successfully");
        return redirect()->route("admin.slider.index");
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $slider = Slider::findOrFail($id); 
        $this->deleteImage($slider->banner);
        $slider->delete();
        return response(["status" => "success","message" => "Deleted Slider","is_empty" => isTableEmpty(Slider::get())]);
    }

    // Change Status 
    public function changeStatus(string $id){
        $slider = Slider::findOrFail($id); 
        $newStatus = !$slider->status; 
        $slider->update(["status" => $newStatus]);
        return response([
            "status" => "success",
            "message" => "Updated Slider Status", 
            
        ]);
    }
    
    // Change Serial 
    public function changeSerial(Request $request,string $id){
        $slider = Slider::findOrFail($id); 
        $serial = $request->serial; 
        $slider->update(["serial" => $serial]);
        return response(["status" => "success","message" => "Updated slider Serial"]);
    }

}
