<?php

namespace App\Http\Controllers;

use App\Models\PrintCart;
use Illuminate\Http\Request;

class PrintCartController extends Controller
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
        $request->apiValidate([
            // 'file_id' => 'required|exists:files,id',
            'files' => 'array',
            'files.*' => 'required|exists:files,id',
        ]);

        $data = [];

      //  dd($request['files']) ;
        foreach ($request['files'] as $file) {
        //    dd($file);
            PrintCart::updateOrCreate([
                'file_id' => $file,
                'user_id' => 1
            ], [
                'file_id' => $file,
                'user_id' => 1
            ]);
        }

        return $this->createdResponse([]);

        //  $data[]=[ 'file_id'=>$file , 'user_id'=>1 ] ;

        //  PrintCart()->createMany
    }

    /**
     * Display the specified resource.
     */
    public function show(PrintCart $printCart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PrintCart $printCart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PrintCart $printCart)
    {
        //
    }
}
