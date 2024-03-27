<?php

namespace App\Http\Controllers;

use App\Models\Design;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DesignCotroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd(request()->all());
        return Design::filter()->paginate22();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->apiValidate([

            'print_type' => 'required',
            'design_type' => 'required',
            'downloadable' => 'boolean',
            'private' => 'required|boolean',
            'designer_id' => 'required|exists:users,id',
            'package' => 'required',
            'category_id' => 'required|exists:categories,id',
            'colors' => 'array',
            'colors.*' => 'exists:palette,id',
            'pinterest_link' => 'nullable',
        ]);
        $design = DB::transaction(function () use ($validator) {
            $design = Design::create($validator->validated());
            // $design->tags()->sync($validator-)
            return $design;
        });
        return $this->createdResponse($design);
    }

    /**
     * Display the specified resource.
     */
    public function show(Design $design)
    {
        return $this->retrieve($design->loady());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Design $design)
    {
        $validator = $request->apiValidate([

            'print_type' => 'sometimes',
            'design_type' => 'sometimes',
            'downloadable' => 'sometimes',
            'private' => 'sometimes|boolean',
            'designer_id' => 'sometimes|exists:users,id',
            'package' => 'sometimes',
            'category_id' => 'nullable|exists:categories,id',
            'colors' => 'array',
            'pinterest_link' => 'nullable',
            'tag_ids' => 'array|sometimes',
            'tag_ids.*' => 'exists:tags,id',

        ]);
        $design = DB::transaction(function () use ($validator, $design, $request) {
            $design->update($validator->validated());

            if ($request->filled('tag_ids'))
                $design->tags()->sync($request->tag_ids);

            return $design;
        });

        return $this->updatedResponse($design);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Design $design)
    {
        //
    }

    public function downloadFiles(Design $design)
    {
        return $design->files;
    }
}
