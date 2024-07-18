<?php

namespace App\Http\Controllers;

use App\Models\FabricMaterial;
use Illuminate\Http\Request;

class FabricMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->retrieve(FabricMaterial::filter()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(FabricMaterial $fabricMaterial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FabricMaterial $fabricMaterial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FabricMaterial $fabricMaterial)
    {
        //
    }
}
