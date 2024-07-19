<?php

namespace App\Http\Controllers;

use App\Models\PageBuilder;
use Illuminate\Http\Request;

class PageBuilderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PageBuilder::filter()->paginate22();

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->apiValidate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $pages_builder = PageBuilder::create($validator->validated());
        return $this->createdResponse($pages_builder);
    }

    /**
     * Display the specified resource.
     */
    public function show(PageBuilder $pageBuilder)
    {
        return $this->retrieve($pageBuilder);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PageBuilder $pageBuilder)
    {
        $validator = $request->apiValidate([
            'title' => 'sometimes',
            'content' => 'sometimes'
        ]);

        $pages_builder = $pageBuilder->update($validator->validated());
        return $this->updatedResponse($pages_builder);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PageBuilder $pageBuilder)
    {
        $pageBuilder->delete();
        return $this->deletedResponse();
    }
}
