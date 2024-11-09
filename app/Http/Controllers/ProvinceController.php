<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum', ['only' => ['store', 'update','delete']]);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $provinces = Province::all();
        return $this->retrieve($provinces);
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
    public function show(Province $province)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Province $province)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Province $province)
    {
        //
    }
}
