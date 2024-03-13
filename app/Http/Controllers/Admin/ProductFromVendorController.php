<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\ProductFromVendorDataTable;
class ProductFromVendorController extends Controller
{
    function index(ProductFromVendorDataTable $dataTable)
    {
        return $dataTable->render("admin.product-from-vendor.index");
    }
}
