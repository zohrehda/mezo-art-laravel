<?php

namespace App\Http\Controllers;

use App\Models\Design;
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
            'name' => 'required',
            'design_id' => 'required|exists:designs,id'
        ]);
        $file = $request->file('file');

        $name = Str::random(10) . '-' . Carbon::now() . '.' . $file->guessClientExtension();
        $path = $file->storeAs('designs', $name);

        $design = Design::find($request->design_id);
 
        $design_file = DesignFile::create([
            'design_id' => $request->design_id,
            'fake_file_path' => 'app/' . $path,
            // 'code' => Str::random(10),
            // 'code' => rand(100000, 999999),
            'code' => $request->name,
            'extension' => $file->guessClientExtension(),
            'size' => $file->getSize(),
            'mime_type' => $file->getMimeType(),
            'width' => getimagesize($file)[0] ?? null,
            'height' => getimagesize($file)[1] ?? null,
        ]);


        return $this->response(trans('messages.uploaded', ['attribute']), $design_file);

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
        $validator = $request->apiValidate([
            'name' => 'sometimes',
        ]);
        $designFile->update($validator->validated());
        return $this->retrieve($designFile);
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
        //  dd($designFile->fake_file_path) ;
        return response()->file(storage_path($designFile->fake_file_path));
    }

}
