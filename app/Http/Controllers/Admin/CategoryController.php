<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CategoryDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
class CategoryController extends Controller
{
    use UploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->render("admin.category.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.category.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            "name" => ["required", "unique:categories,name"],
            "icon" => ["required"],
            "status" => ["required"],
            "image" => ["image"],
        ]);
        $image = $this->uploadImage($request,"uploads","image");
        Category::create([
            "image" => $image,
            "name" => $request->name,
            "icon" => $request->icon,
            "status" => $request->status,
            "slug" => Str::slug($request->name)
        ]);
        return redirect()->route("admin.category.index");
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
        $category = Category::findOrFail($id);
        return view("admin.category.edit", [
            "category" => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);
        $request->validate([
            "name" => ["required", "unique:categories,name," . $id],
            "status" => ["required"],
            "image" => ["image"],
        ]);
        $image = $this->updateImage($request,$category->image,"uploads","image");
        if (empty($request->icon)) $newIcon = $category->icon;
        else $newIcon =  $request->icon;
        $category->update([     
            "image" => $image ? $image : $category->image, 
            "name" => $request->name,
            "icon" => $newIcon,
            "status" => $request->status,
        ]);
        Session::flash("status", "Update category successfully");
        return redirect()->route("admin.category.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        // $count = $category->subCategories->count("id");
        // if ($count > 0) return response([
        //     "status" => "error",
        //     "message" => "Can't delete the category when it contains sub category",
        // ]);
        // else 
        $this->deleteImage($category->image);
        $category->delete();
        return response([
            "status" => "success",
            "message" => "Deleted category successfully",
            "is_empty" => isTableEmpty(Category::get()),
        ]);
    }

    public function changeStatus(string $id)
    {
        $category = Category::findOrFail($id);
        $status = $category->status;
        if ($status == 1) $category->status = 0;
        else $category->status = 1;
        $category->save();
        return response([
            "status" => "success",
            "message" => "Updated Category Status",
        ]);
    }
}

