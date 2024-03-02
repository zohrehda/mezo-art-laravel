<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    /**
     * Instantiate a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth:sanctum')->only(['store', 'update']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::filter()->withCount('comments')->get();
        return $this->retrieve($blogs);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->apiValidate([
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'exists:categories,id',
            'status' => 'boolean',
            'tag_ids' => 'array'
        ]);
        $blog = DB::transaction(function () use ($validator, $request) {

            $blog = Blog::create($validator->validated() + ['slug' => Str::slug($request->title), 'author_id' => auth()->user()->id]);
            $blog->tags()->sync($request->tag_ids);
            return $blog;
        });
        return $this->createdResponse($blog);
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return $this->retrieve($blog->loady());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $validator = $request->apiValidate([
            'title' => 'sometimes',
            'content' => 'sometimes',
            'category_id' => 'sometimes|nullable|exists:categories,id',
            'status' => 'boolean',
            'tag_ids' => 'array',
            'tag_ids.*' => 'exists:tags,id'
        ]);

        $blog = DB::transaction(function () use ($validator, $request, $blog) {
            $blog->update($validator->validated() + ['slug' => Str::slug($request->title)]);

            if ($request->tag_ids)
                $blog->tags()->sync($request->tag_ids);

            return $blog->refresh();

        });

        return $this->updatedResponse($blog);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return $this->deletedResponse();
    }
}
