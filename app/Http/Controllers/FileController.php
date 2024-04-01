<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class FileController extends Controller
{

    public function upload(Request $request)
    {

        $request->apiValidate([
            'file' => 'file|required',
            'section' => 'nullable'
        ]);
        $file = $request->file('file');


        $name = Str::random(10) . '-' . Carbon::now() . '.' . $file->guessClientExtension();
        //  Storage::put('blogs/' . $name, file_get_contents($file));
        $path = $file->storeAs('blogs', $name);

        $file = File::create([
            'path' => 'app/' . $path,
            'extension' => $file->guessClientExtension(),
            'size' => $file->getSize(),
            'mime_type' => $file->getMimeType(),
            'section' => $request->input('section')
        ]);

        return $this->createdResponse($file);

    }
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

    }

    /**
     * Display the specified resource.
     */
    public function show(File $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, File $file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(File $file)
    {
        $file->delete();
        return $this->deletedResponse();
    }

    public function download(Request $request, File $file)
    {
        return response()->file(storage_path($file->path));
    }
}
