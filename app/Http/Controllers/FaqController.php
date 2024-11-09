<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
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
        return Faq::filter()->paginate22() ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator=$request->apiValidate([
            'question'=>'required',
            'answer'=>'required',
            'content'=>'nullable',
            'category_id'=>'exists:categories,id'
           // 'category_ids'=>'array',
            //'category_ids.*'=>'in:categories,id',
        ]);

        $faq=Faq::create($validator->validated());

        return $this->createdResponse($faq) ;
    }

    /**
     * Display the specified resource.
     */
    public function show(Faq $faq)
    {
        return $this->retrieve($faq->loady()) ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Faq $faq)
    {
        $validator=$request->apiValidate([
            'question'=>'sometimes',
            'answer'=>'sometimes',
            'content'=>'sometimes',
            'category_id'=>'exists:categories,id'
        ]);
        $faq=$faq->update($validator->validated());
        return $this->updatedResponse($faq) ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faq $faq)
    {
        $faq->delete();
        return $this->deletedResponse();
    }
}
