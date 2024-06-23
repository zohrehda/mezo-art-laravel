<?php

namespace App\Http\Controllers;

use App\Models\Route;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->retrieve(Route::filter()->get());
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
    public function show(Route $route)
    {
        return $this->retrieve($route->loady());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Route $route)
    {
        $validator = $request->apiValidate([
            'slug' => 'sometimes',
            'title' => 'sometimes',
            'page_builder_id' => 'sometimes',
            'description' => 'sometimes',
            'redirect_code' => 'sometimes',
            'redirect_url' => 'sometimes',
        ]);

        if ($request->has('image1_id'))
            $route->files()->withPivotValue('section', 'image1')->sync($request->image1_id ? [$request->image1_id] : []);


        if ($request->has('image2_id'))
            $route->files()->withPivotValue('section', 'image2')->sync($request->image2_id ? [$request->image2_id] : []);


        if ($request->has('image3_id'))
            $route->files()->withPivotValue('section', 'image3')->sync($request->image3_id ? [$request->image3_id] : []);

        if ($request->has('poster'))
            $route->files()->withPivotValue('section', 'poster')->sync($request->poster ? [$request->poster] : []);


        $route->update($validator->validated());

        return $this->updatedResponse($route);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Route $route)
    {
        //
    }
}
