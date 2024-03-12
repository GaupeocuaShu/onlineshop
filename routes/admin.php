<?php

use App\Http\Controllers\admin\SliderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
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
