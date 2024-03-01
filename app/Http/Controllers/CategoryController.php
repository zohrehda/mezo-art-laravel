<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $ds = $request->ds;
        $categories = ($ds == 'flat') ? Category::filter()->get() : Category::filter()->where('parent_id', null)->with('children')->get();
        return $this->retrieve($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->apiValidate([
            'name' => 'required',
            'type' => 'nullable|in:blog,design',
            'parent_id' => 'nullable|exists:categories,id',
        ]);
        $category = Category::create($validator->validated());
        return $this->createdResponse($category);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
