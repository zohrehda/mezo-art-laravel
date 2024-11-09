<?php

namespace App\Http\Controllers;

use App\Models\FabricMaterial;
use Illuminate\Http\Request;

class FabricMaterialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->only(['store', 'update','delete']);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return FabricMaterial::filter()->paginate22();
        return $this->retrieve(FabricMaterial::filter()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->apiValidate([
            'name' => 'sometimes'
        ]);
        $fabricMaterial = FabricMaterial::create($validator->validated());
        return $this->createdResponse($fabricMaterial);
    }

    /**
     * Display the specified resource.
     */
    public function show(FabricMaterial $fabricMaterial)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FabricMaterial $fabricMaterial)
    {
        $validator = $request->apiValidate([
            'name' => 'sometimes'
        ]);

        $fabricMaterial->update($validator->validated());

        return $this->updatedResponse($fabricMaterial);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FabricMaterial $fabricMaterial)
    {
        $fabricMaterial->delete();
        return $this->deletedResponse();
    }
}
