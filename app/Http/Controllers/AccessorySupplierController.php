<?php

namespace App\Http\Controllers;

use App\Models\AccessorySupplier;
use Illuminate\Http\Request;

class AccessorySupplierController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('index');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return AccessorySupplier::filter()->paginate22();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->apiValidate([
            'title' => 'required',
            'description' => 'required',
            'type' => 'required',
            'design_id' => 'required',

        ]);

        $accessorySupplier = AccessorySupplier::create($validator->validated() + [
            'user_id' => auth()->user()->id
        ]);
        return $this->response(trans('supply.request'), $accessorySupplier);
    }

    /**
     * Display the specified resource.
     */
    public function show(AccessorySupplier $accessorySupplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AccessorySupplier $accessorySupplier)
    {
        $validator = $request->apiValidate([
            'title' => 'sometimes',
            'description' => 'sometimes',
            'type' => 'sometimes',
            'status' => 'sometimes|boolean'
        ]);

        $accessorySupplier->update($validator->validated());

        return $this->updatedResponse($accessorySupplier->refresh());

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AccessorySupplier $accessorySupplier)
    {
        $accessorySupplier->delete();
        return $this->deletedResponse();
    }

    public function me(Request $request)
    {
        return AccessorySupplier::filter()->where('user_id', auth()->user()->id)->paginate22();
    }
}
