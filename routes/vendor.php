<?php
use App\Models\Category;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Vendor\ProductController;
use App\Http\Controllers\Vendor\ProductImageGalleryController;
use App\Http\Controllers\Vendor\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Vendor\ShopProfileController;
use Illuminate\Http\Request;

// Profile -------------------------------------------------
Route::post("profile-update",[ProfileController::class,"profileUpdate"])->name("profile-update");

Route::post("password-update",[ProfileController::class,"passwordUpdate"])->name("password-update");

Route::get("profile",[ProfileController::class,"index"])->name("profile");
// Profile -------------------------------------------------


// Shop Profile -------------------------------------------------

Route::resource("shop-profile", ShopProfileController::class);

// Shop Profile -------------------------------------------------

// Product -------------------------------------------------

Route::post("category/get-sub-categories",function(Request $request){
    $categoryID = $request->categoryID; 
    $subCategories = Category::findOrFail($categoryID)->subCategories;
    return response( ["subCategories" => $subCategories]);
})->name("category.get-sub-categories");

Route::put("product/{id}/change-status", [ProductController::class, "changeStatus"])->name("product.change_status");
Route::put("product/change-type", [ProductController::class, "changeType"])->name("product.change_type");
Route::resource("product", ProductController::class);
// Product -------------------------------------------------


// Product Gallery  -------------------------------------------------
Route::resource("product.image-gallery", ProductImageGalleryController::class);
// Product Gallery  -------------------------------------------------



