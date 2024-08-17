<?php

namespace App\Http\Controllers;

use App\Enums\DesignPrintType;
use App\Enums\DesignType;
use App\Enums\PrintOrderStatus;
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
            ->paginate22();
    }

    public function me()
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
            'user_id' => 'nullable|exists:users,id'
        ]);

        $printOrder = PrintOrder::create(
            $validator->safe()->except(['user_id']) +
                [
                    'user_id' => $request->input('user_id') ?: auth()->user()->id,
                    'code' => rand(100000, 999999),
                    'created_by' => auth()->user()->id
                ]
        );
        return $this->createdResponse($printOrder);
    }

    /**
     * Display the specified resource.
     */
    public function show(PrintOrder $printOrder)
    {
        return $this->retrieve($printOrder->load('roll', 'patterns', 'orderFiles.file', 'assessment', 'process'));
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
            'fabric_material_id' => 'nullable',
            'roll_condition' => 'nullable',
            'roll_shape' => 'nullable',
            'roll_size' => 'nullable',
            'roll_count' => 'nullable',
            'roll_width' => 'nullable',
            'press' => 'boolean',
            'patterns' => 'array',
            'designs' => 'array',
            'assessment' => 'array|nullable',
            'process' => 'array',
            'admin_access' => 'boolean',
            'user_access' => 'boolean',

        ]);


        $design_type = $printOrder->design_type;
        $data = $validator->validated() + [
            'updated_by' => auth()->user()->id,

        ];
        // dd($request->input('final'))
        if ($request->input('final') == true)
            $data['status'] = PrintOrderStatus::UNDERGRADUATE;

        $printOrder->update($data);



        $printOrder->assessment()->updateOrCreate([
            'print_order_id' => $printOrder->id,
        ], $request->input('assessment', []));

        $printOrder->process()->updateOrCreate([
            'print_order_assessment_id' => $printOrder->assessment->id,
            'print_order_id' => $printOrder->id,
        ], $request->input('process', []));

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

        // dd($printOrder->patterns->toArray()['0']);

        $printOrder->orderFiles()->sync(array_map(function ($item) use ($printOrder) {
            return [
                'design_width' => $item['design_width'] ?? null,
                'design_height' => $item['design_height'] ?? null,
                'design_resize_scale' => $item['design_resize_scale'] ?? null,
                'design_direction' => $item['design_direction'] ?? null,
                'pattern_id' => isset($item['pattern_index']) ? $printOrder->patterns->toArray()[$item['pattern_index']]['id'] ?? null : null,
                'count' => $item['count'] ?? null,
                'print_size' => $item['print_size'] ?? null,
                'id' => $item['id'],
                'design_file_id' => $item['file_id']
            ];
        }, $request->input('designs', [])));


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

    public function report(PrintOrder $printOrder)
    {
        // dd('ff');
        return view('reports.print_order');

        return Pdf::view('reports.print_order')
            ->format('a4')
            ->name('your-invoice.pdf');;
    }
}
