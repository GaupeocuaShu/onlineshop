<?php
namespace App\Traits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
trait UploadTrait{
    public function uploadImage(Request $request,$pathName,$inputName)
    {
        if($request->hasFile($inputName)){ 
            $image = $request->$inputName;
            $imageName = date('Y-m-d')."_".$image->getClientOriginalName();
            $path = $pathName."/".$imageName;
            $image->move(public_path($pathName),$imageName);
            return $path;
        }
    }

    public function updateImage(Request $request,$oldAvatar,$pathName,$inputName){ 
        if($request->hasFile($inputName)){ 
            if(File::exists(public_path($oldAvatar))) File::delete(public_path($oldAvatar)); 
            $image = $request->$inputName;
            $imageName = date('Y-m-d')."_".$image->getClientOriginalName();
            $path = $pathName."/".$imageName;
            $image->move(public_path($pathName),$imageName);
            return $path;
        }
    }
    public function uploadMultiImage(Request $request, $name, $pathName)
    {
        $paths = array();
        $images = $request->$name;
        foreach ($images as $image) {
            $imageName = date("Y-m-d") . "_" . $image->getClientOriginalName();
            $image->move(public_path($pathName), $imageName);
            $path = $pathName . "/" . $imageName;
            $paths[] = $path;
        }
        return $paths;
    }
    public function deleteImage(string $path)
    {
        if (File::exists(public_path($path))) File::delete(public_path($path));
    }
}