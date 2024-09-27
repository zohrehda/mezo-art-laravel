<?php

namespace App\Http\Controllers;

use App\Models\Design;
use App\Models\Views\DesignView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DesignCotroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return DesignView::filter()
    
        ->paginate22();
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
            'private_users' => 'array',
            'colored_fabric' => 'required|boolean',
            'designer_id' => 'required|exists:users,id',
            'tag_ids' => 'array',
            'related_ids' => 'array',
            'related_ids.*' => 'exists:designs,id',
            'package' => 'required',
            'category_id' => 'required|exists:categories,id',
            'color_ids' => 'array',
            'color_ids.*' => 'exists:palette,id',
            'pinterest_link' => 'nullable',
            'site_file_ids' => 'array',
            'print_file_ids' => 'array'
        ]);
        $design = DB::transaction(function () use ($validator) {
            $design = Design::create($validator->validated());
            $design->users()->sync($validator->validated()['private_users'] ?? []);
            $design->tags()->sync($validator->validated()['tag_ids'] ?? []);
            $design->siteFiles()->sync($validator->validated()['site_file_ids'] ?? []);
            $design->printFiles()->sync($validator->validated()['print_file_ids'] ?? []);

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
            'private_users' => 'sometimes|array',
            'colored_fabric' => 'sometimes|boolean',
            'designer_id' => 'sometimes|exists:users,id',
            'package' => 'sometimes',
            'category_id' => 'nullable|exists:categories,id',
            'color_ids' => 'array',
            'pinterest_link' => 'nullable',
            'tag_ids' => 'array|sometimes|exists:tags,id',
            'tag_ids.*' => 'exists:tags,id',
            'related_ids' => 'array',
            'related_ids.*' => 'exists:designs,id',
            'site_file_ids' => 'array',
            'print_file_ids' => 'array'

        ]);
        $design = DB::transaction(function () use ($validator, $design, $request) {
            $design->update($validator->validated());

            if ($request->filled('private_users'))
                $design->users()->sync($validator->validated()['private_users'] ?? []);

            if ($request->filled('tag_ids'))
                $design->tags()->sync($validator->validated()['tag_ids'] ?? []);

            if ($request->filled('site_file_ids'))
                $design->siteFiles()->sync($validator->validated()['site_file_ids'] ?? []);

            if ($request->filled('print_file_ids'))
                $design->printFiles()->sync($validator->validated()['print_file_ids'] ?? []);


            return $design;
        });

        return $this->updatedResponse($design);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Design $design)
    {
        $design->delete();
        return $this->deletedResponse();
    }

    public function downloadFiles(Design $design)
    {
        return $design->files;
    }
}
