<?php

namespace App\Http\Controllers;

use App\Models\PrintOrderPattern;
use Illuminate\Http\Request;

class PrintOrderPatternController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->apiValidate([
            'print_order_id' => 'required|exists:print_orders,id',
            'name' => 'required',
            'width' => 'required',
            'height' => 'required',
            'count' => 'required',
        ]);
        $printOrderPattern = PrintOrderPattern::create($validator->validated());
        return $this->createdResponse($printOrderPattern);
    }

    /**
     * Display the specified resource.
     */
    public function show(PrintOrderPattern $printOrderPattern)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PrintOrderPattern $printOrderPattern)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PrintOrderPattern $printOrderPattern)
    {
        $validator = $request->apiValidate([
            //   'print_order_id' => 'required|exits:print_orders,id',
            'name' => 'required',
            'width' => 'required',
            'height' => 'required',
            'count' => 'required',
        ]);
        $printOrderPattern->update($validator->validated());
        return $this->updatedResponse($printOrderPattern);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PrintOrderPattern $printOrderPattern)
    {
        $printOrderPattern->delete();
        return $this->deletedResponse();
    }
}
