<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::filter()->get();
        return $this->retrieve($tags);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->apiValidate([
            'name' => 'required'
        ]);
        $tag = Tag::create($validator->validated());
        return $this->createdResponse($tag);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        return $this->retrieve($tag->loady());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        $validator = $request->apiValidate([
            'name' => 'sometimes'
        ]);
        $tag = $tag->update($validator->validated());
        return $this->updatedResponse($tag);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return $this->deletedResponse();
    }
}
