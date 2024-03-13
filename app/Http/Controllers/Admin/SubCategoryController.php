<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\SubCategoryDataTable; 
use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SubCategoryDataTable $dataTable)
    {
        return $dataTable->render("admin.subcategory.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view("admin.subcategory.create", [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => ["required", "unique:sub_categories,name"],
            "category_id" => ["not_in:Select", "required"],
            "status" => ["required"],
        ]);
        SubCategory::create([
            "category_id" => $request->category_id,
            "name" => $request->name,
            "status" => $request->status,
            "slug" => Str::slug($request->name),
        ]);
        Session::flash("status", "Create sub category successfully");
        return redirect()->route("admin.sub-category.index");
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
        $categories = Category::all();
        $subCategory = SubCategory::findOrFail($id);
        return view("admin.subcategory.edit", [
            "subCategory" => $subCategory,
            "categories" => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "name" => ["required", "unique:sub_categories,name," . $id],
            "category_id" => ["not_in:Select", "required"],
            "status" => ["required"],
        ]);
        $subCategory = SubCategory::findOrFail($id);
        $subCategory->update([
            "name" => $request->name,
            "category_id" => $request->category_id,
            "status" => $request->status,
        ]);
        Session::flash("status", "Update sub category successfully");
        return redirect()->route("admin.sub-category.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subCategory = SubCategory::findOrFail($id);
        $subCategory->delete();
        return response([
            "status" => "success",
            "message" => "Deleted sub category successfully",
            "is_empty" => isTableEmpty(SubCategory::get()),
        ]);
    }

    public function changeStatus(string $id)
    {
        $subCategory = SubCategory::findOrFail($id);
        $newStatus = $subCategory->status == 1 ? 0 : 1;
        $subCategory->update([
            "status" => $newStatus,
        ]);
        return response([
            "status" => "success", 
            "message" => "Updated Sub Category Status",
        ]);
    }

}
