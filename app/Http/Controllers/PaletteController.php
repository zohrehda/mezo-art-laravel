<?php

namespace App\Http\Controllers;

use App\Models\Palette;
use Illuminate\Http\Request;

class PaletteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $palette = Palette::filter()->get();
        return $this->retrieve($palette);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Palette $palette)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Palette $palette)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Palette $palette)
    {
        //
    }
}
