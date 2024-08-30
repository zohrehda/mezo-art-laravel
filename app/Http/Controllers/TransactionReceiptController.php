<?php

namespace App\Http\Controllers;

use App\Models\TransactionReceipt;
use Illuminate\Http\Request;

class TransactionReceiptController extends Controller
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
            'amount' => '',
            'installment_id' => 'required',
            'transaction_num' => 'required',
            'payment_date' => '',
        ]);
        $transactionReceipt = TransactionReceipt::create($validator->validated());
        
        return $this->retrieve($transactionReceipt);
    }

    /**
     * Display the specified resource.
     */
    public function show(TransactionReceipt $transactionReceipt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TransactionReceipt $transactionReceipt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TransactionReceipt $transactionReceipt)
    {
        //
    }
}
