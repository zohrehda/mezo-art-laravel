<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->only(['store', 'update','delete']);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Page::filter()->paginate22();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator=$request->apiValidate([
            'title'=>'required' ,
            'content'=>'nullable'
        ]) ;
        $page=Page::create($validator->validated()) ;
        return $this->createdResponse($page) ;
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        return $this->retrieve($page) ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Page $page)
    {
        $validator=$request->apiValidate([
            'title'=>'sometimes' ,
            'content'=>'sometimes'
        ]) ;

        $page->update($validator->validated()) ;
        return $this->updatedResponse($page);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        $page->delete();
        return $this->deletedResponse();
    }
}
