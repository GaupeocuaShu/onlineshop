<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\UserAddresses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => ["required","string"], 
            "phone" => ["required",'string'],
            "country" => ["required",'string'],
            "state" => ["required",'string'],
            "city" => ["required",'string'],
            "zip" => ["required",'string'],
            "address" => ["required",'string'],
            "type" => ["required",'string']
        ]);
        UserAddresses::create([
            "user_id" => Auth::user()->id,
            "name" => $request->name, 
            "phone" => $request->phone, 
            "country" => $request->country, 
            "state" => $request->state, 
            "city" => $request->city, 
            "zip" => $request->zip, 
            "address" => $request->address, 
            "type" => $request->type,  
            "is_default" => $request->is_default ? true :false,
        ]); 
        return response([
            "status" => "success", 
            "message" => "Added New Address",
        ]) ;
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
