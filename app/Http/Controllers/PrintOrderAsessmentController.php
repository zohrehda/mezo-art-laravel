<?php

namespace App\Http\Controllers;

use App\Models\PrintOrder;
use App\Models\PrintOrderAssessment;
use Illuminate\Http\Request;

class PrintOrderAsessmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->apiValidate([
            'approval_method' => 'string',
            'operator_approval_date' => 'string',
            'sample_approval_date' => 'string',
            'description' => 'string',
        ]);

        $PrintOrderAssessment = PrintOrderAssessment::updateOrCreate(
            [
                'print_order_id' => ''
            ],
            $validator->validated()
        );

        return $this->createdResponse($PrintOrderAssessment);
    }

    /**
     * Display the specified resource.
     */
    public function show(PrintOrderAssessment $printOrderAssessment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PrintOrder $printOrder)
    {
        $validator = $request->apiValidate([
            'approval_method' => 'string',
            'operator_approval_date' => 'string',
            'sample_approval_date' => 'string',
            'description' => 'string',
        ]);

        $PrintOrderAssessment = PrintOrderAssessment::updateOrCreate(
            [
                'print_order_id' => $printOrder
            ],
            $validator->validated()
        );
        
        return $this->updatedResponse($PrintOrderAssessment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PrintOrderAssessment $printOrderAssessment)
    {
        //
    }
}
