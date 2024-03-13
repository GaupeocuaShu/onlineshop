<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\UploadTrait; 
use App\Models\ProductImageGallery;
use App\Models\Product; 
use App\DataTables\ProductImageGalleryDataTable;
class ProductImageGalleryController extends Controller
{
    use UploadTrait;
    public function index(ProductImageGalleryDataTable $dataTable, string $id)
    {
        $product = Product::findOrFail($id);
        return $dataTable->with("productID", $id)->render("vendor.product.image-gallery.index", compact("product"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(Request $request, string $id)
    {
        // dd($request->all());
        $request->validate([
            "images" => ["required"],
            "images.*" => ["image"],
        ], [
            "images.required" => "No image selected"
        ]);
        $paths = $this->uploadMultiImage($request, "images", "uploads");
        foreach ($paths as $path) {
            ProductImageGallery::create([
                "product_id" => $id,
                "image" => $path,
            ]);
        }
        return redirect()->back();
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

    public function destroy(string $product_id, string $id)
    {
        $productImage = ProductImageGallery::findOrFail($id);
        $this->deleteImage($productImage->image);
        $productImage->delete(); 
        return response([
            "status" => "success",
            "message" => "Deleted Image In Gallery Successfully",
            "is_empty" => isTableEmpty(ProductImageGallery::where("product_id",$product_id)->get())
        ]);
    }
}
