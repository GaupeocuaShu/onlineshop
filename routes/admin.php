<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\Category;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\admin\ProfileController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\Admin\SubCategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
// Profile -------------------------------------------------
Route::post("profile-update",[ProfileController::class,"profileUpdate"])->name("profile.profile-update");

Route::post("password-update",[ProfileController::class,"passwordUpdate"])->name("profile.password-update");

Route::get("profile",[ProfileController::class,"index"])->name("profile");
// Profile -------------------------------------------------

// User -------------------------------------------------
Route::resource('user', UserController::class);
// User -------------------------------------------------


// Slider ------------------------------------------------
// Change Status 
Route::put("slider/{id}/change-status",[SliderController::class,"changeStatus"])->name("slider.change-status");
// Change Serial 
Route::put("slider/{id}/change-serial",[SliderController::class,"changeserial"])->name("slider.change-serial");
Route::resource("slider",SliderController::class);
// Slider ------------------------------------------------



// Brand ------------------------------------------------
Route::put("brand/{id}/change-status",[BrandController::class,"changeStatus"])->name("brand.change-status");
Route::put("brand/{id}/change-featured",[BrandController::class,"changeFeatured"])->name("brand.change-featured");
Route::resource("brand",BrandController::class);
// Brand ------------------------------------------------



// Category ------------------------------------------------
Route::put("category/{id}/change-status",[CategoryController::class,"changeStatus"])->name("category.change-status");
Route::resource("category",CategoryController::class);
// Category ------------------------------------------------


//Sub Category ------------------------------------------------
Route::put("sub-category/{id}/change-status", [SubCategoryController::class, "changeStatus"])->name("sub-category.change-status");
Route::resource("sub-category", SubCategoryController::class);
//Sub Category ------------------------------------------------
