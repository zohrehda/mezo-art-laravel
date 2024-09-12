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
        return ($ds == 'flat') ? Category::filter()->paginate22() : Category::filter()->where('parent_id', null)->with('children')->paginate22();
        return $this->retrieve($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->apiValidate([
            'name' => 'required',
            'type' => 'nullable|in:blog,design,faq',
            'parent_id' => 'nullable|exists:categories,id',
            'color' => 'sometimes'
        ]);
        $category = Category::create($validator->validated());
        if ($request->has('image')) {
            $category->image()->sync($request->input('image') ? [
                $request->input('image')['id']
            ] : []);
        }
        return $this->createdResponse($category);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return $this->retrieve($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validator = $request->apiValidate([
            'name' => 'sometimes',
            'type' => 'nullable|in:blog,design,faq',
            'parent_id' => 'nullable|exists:categories,id',
            'color' => 'sometimes'
        ]);
        $category = $category->update($validator->validated());
        return $this->updatedResponse($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return $this->deletedResponse();
    }
}
