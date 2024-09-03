<?php

namespace App\Http\Controllers;

use App\Enums\PrintOrderStatus;
use App\Models\Installment;
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
        //admin_confirmation
        $installment =  Installment::find($request->installment_id);
        if ($installment->type == 'prepayment')
            $installment->printOrder()
                ->update([
                    'status' => PrintOrderStatus::ADMIN_CONFIRMATION
                ]);

        $transactionReceipt = TransactionReceipt::create($validator->validated());

        return $this->retrieve($transactionReceipt->load('installment'));
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
        $validator = $request->apiValidate([
            'is_paid' => 'boolean',
            'transaction_num' => 'sometimes'
        ]);

        $transactionReceipt->update($validator->validated());

        $transactionReceipt->installment()->update([
            'is_paid' => $request->input('is_paid')
        ]);

        return $this->updatedResponse($transactionReceipt->load('installment'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TransactionReceipt $transactionReceipt)
    {
        //
    }
}
