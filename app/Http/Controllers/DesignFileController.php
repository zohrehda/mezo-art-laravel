<?php

namespace App\Http\Controllers;

use App\Models\DesignFile;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DesignFileController extends Controller
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
            'file' => 'required|file',
            'design_id' => 'required|exists:designs,id'
        ]);
        $file = $request->file('file');

        $name = Str::random(10) . '-' . Carbon::now() . '.' . $file->guessClientExtension();
        $path = $file->storeAs('designs', $name);

        $design_file = DesignFile::create([
            'design_id' => $request->design_id,
            'fake_file_path' => 'app/' . $path,
            'code' => Str::random(10),
            'extension' => $file->guessClientExtension(),
            'size' => $file->getSize(),
            'mime_type' => $file->getMimeType(),
            'width' => getimagesize($file)[0] ?? null,
            'height' => getimagesize($file)[0] ?? null,

        ]);

        return $this->response(trans('messages.uploaded', ['attribute']));

    }

    /**
     * Display the specified resource.
     */
    public function show(DesignFile $designFile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DesignFile $designFile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DesignFile $designFile)
    {
        $designFile->delete();
        return $this->deletedResponse();
    }

    public function download(Request $request, DesignFile $designFile)
    {
        return response()->file(storage_path($designFile->fake_file_path));
    }

}
