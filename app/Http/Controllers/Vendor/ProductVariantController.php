<?php

namespace App\Http\Controllers\Vendor;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product; 
use App\Models\ProductVariant; 
use App\DataTables\ProductVariantDataTable;
use Illuminate\Support\Facades\Session;
class ProductVariantController extends Controller
{
    public function index(ProductVariantDataTable $dataTable, $id)
    {

        $product = Product::findOrFail($id);
        return $dataTable->with("id", $id)->render("vendor.product.variant.index", compact("product"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $productID)
    {
        $product = Product::findOrFail($productID);
        return view("vendor.product.variant.create", compact("product"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $productID)
    {
        $request->validate([
            "name" => "required",
            "status" => "required"
        ]);
        ProductVariant::create([
            "product_id" => $productID,
            "name" => $request->name,
            "status" => $request->status,
        ]);
        Session::flash("status", "Create Product Variant Successfully");
        return redirect()->route("vendor.product.variant.index", $productID);
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
    public function edit(string $productID, string $variantID)
    {
        $product = Product::findOrFail($productID);
        $variant = ProductVariant::findOrFail($variantID);
        return view("vendor.product.variant.edit", compact("product", "variant"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $productID, string $variantID)
    {
        $role = Auth::user()->role;
        $variant = ProductVariant::findOrFail($variantID);
        $request->validate([
            "name" => "required",
            "status" => "required"
        ]);
        $variant->update([
            "name" => $request->name,
            "status" => $request->status,
        ]);
        Session::flash("status", "Update Product Variant Successfully");
        return redirect()->route("$role.product.variant.index", $productID);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $productID, string $variantID)
    {
        $variant = ProductVariant::findOrFail($variantID);
        // $variantItems = $variant->product_variant_item->all();
        // foreach ($variantItems as $item) {
        //     $item->delete();
        // };
        $variant->delete();
        return response([
            "status" => "success",
            "message" => "Deleted variant successfully",
            "is_empty" => isTableEmpty(ProductVariant::where("product_id",$productID)->get()),
        ]);
    }
    public function changeStatus(string $id)
    {
        $variant = ProductVariant::findOrFail($id);
        $newStatus = $variant->status == 0 ? 1 : 0;
        $variant->update(["status" => $newStatus]);
        return response([
            "status" => "success",
            "message" => "Update Product Variant Successfullt",
        ]);
    }
}
