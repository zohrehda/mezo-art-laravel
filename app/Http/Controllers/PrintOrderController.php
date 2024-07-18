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
        return PrintOrder::filter()
            ->where('user_id', auth()->user()->id)
            ->paginate22();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->apiValidate([
            'print_type' => ['required', new Enum(DesignPrintType::class)],
            'design_type' => ['required', new Enum(DesignType::class)],

        ]);

        $printOrder = PrintOrder::create($validator->validated() +
            [
                'user_id' => auth()->user()->id,
                'code' => rand(100000, 999999)
            ]);

        return $this->createdResponse($printOrder);

    }

    /**
     * Display the specified resource.
     */
    public function show(PrintOrder $printOrder)
    {
        return $this->retrieve($printOrder->load('roll', 'patterns', 'orderFiles.file'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PrintOrder $printOrder)
    {
        $validator = $request->apiValidate([
            'fabric_country_of_origin' => 'nullable',
            'fabric_colorability' => 'nullable',
            'fabric_weight' => 'nullable',
            'fabric_color' => 'nullable',
            'fabric_shrink' => 'nullable',

            'roll_condition' => 'nullable',
            'roll_shape' => 'nullable',
            'roll_size' => 'nullable',
            'roll_count' => 'nullable',
            'roll_width' => 'nullable',
            'patterns' => 'array',
            'designs' => 'array',

        ]);
        $design_type = $printOrder->design_type;
        $printOrder->update($validator->validated());
        if ($design_type == 'pattern')
            $printOrder->roll()->updateOrCreate([
                'print_order_id' => $printOrder->id
            ], $validator->validated());

        if ($design_type == 'single') {
            $printOrder->patterns()->sync(array_map(function ($item) {
                return [
                    'width' => $item['width'],
                    'height' => $item['height'],
                    'count' => $item['count'],
                    'id' => $item['id'],
                    'name' => $item['name']

                ];
            }, $request->patterns));
        }

        $printOrder->orderFiles()->sync(array_map(function ($item) {
            return [
                'design_width' => $item['design_width'] ?? null,
                'design_height' => $item['design_height'] ?? null,
                'design_direction' => $item['design_direction'] ?? null,
                'count' => $item['count'] ?? null,
                'roll_size' => $item['roll_size'] ?? null,
                'id' => $item['id'],
                'design_file_id' => $item['file_id']

            ];
        }, $request->designs));


        return $this->updatedResponse($printOrder->refresh()->load('patterns', 'orderFiles.file'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PrintOrder $printOrder)
    {
        $printOrder->delete();
        return $this->deletedResponse();
    }
}
