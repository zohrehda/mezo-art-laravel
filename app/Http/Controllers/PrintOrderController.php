<?php

namespace App\Http\Controllers;

use App\Enums\DesignPrintType;
use App\Enums\DesignType;
use App\Models\PrintOrder;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class PrintOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PrintOrder::filter()->paginate22();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->apiValidate([
            'print_type' => ['required', new Enum(DesignPrintType::class)],
            'design_type' => ['required', new Enum(DesignType::class)]
        ]);
        $printOrder = PrintOrder::create($validator->validated() + ['user_id' => auth()->user()->id]);

        return $this->createdResponse($printOrder);

    }

    /**
     * Display the specified resource.
     */
    public function show(PrintOrder $printOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PrintOrder $printOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PrintOrder $printOrder)
    {
        //
    }
}
