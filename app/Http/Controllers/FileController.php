<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class FileController extends Controller
{

    public function upload(Request $request)
    {

        // dd($request->all());

        $request->apiValidate([
            'file' => 'file|required',
            'section' => 'nullable',
            'fileable_id' => 'sometimes',
            'fileable_type' => 'sometimes',
        ]);
        $file = $request->file('file');


        $name = Str::random(10) . '-' . Carbon::now() . '.' . $file->guessClientExtension();
        //  Storage::put('blogs/' . $name, file_get_contents($file));
        $path = $file->storeAs('blogs', $name);

        $model = modelResolve($request->fileable_type);
        $file = File::create([
            'path' => 'app/' . $path,
            'extension' => $file->guessClientExtension(),
            'size' => $file->getSize(),
            'mime_type' => $file->getMimeType(),
            'section' => $request->input('section'),
            'fileable_id' => $request->input('fileable_id'),
            'fileable_type' => $model,
        ]);
        if ($request->filled('fileable_id') and $model)
            $model::find($request->input('fileable_id'))->files()->attach([
                $file->id => ['section' => $request->input('section')]
            ]);

        return $this->createdResponse($file);

    }
    public function editorUpload(Request $request)
    {

        // // dd($request->all());

        // $request->apiValidate([
        //     'file' => 'file|required',
        //     'section' => 'nullable',
        //     'fileable_id' => 'sometimes',
        //     'fileable_type' => 'sometimes',
        // ]);
        $file = $request->file('upload');



        $name = Str::random(10) . '-' . Carbon::now() . '.' . $file->guessClientExtension();
        //  Storage::put('blogs/' . $name, file_get_contents($file));
        $path = $file->storeAs('blogs', $name);

        $model = modelResolve($request->fileable_type);

        $file = File::create([
            'path' => 'app/' . $path,
            'extension' => $file->guessClientExtension(),
            'size' => $file->getSize(),
            'mime_type' => $file->getMimeType(),
            'section' => $request->input('section'),
            'fileable_id' => $request->input('fileable_id'),
            'fileable_type' => $model,
        ]);
        if ($request->filled('fileable_id') and $model)
            $model::find($request->input('fileable_id'))->files()->attach([
                $file->id => ['section' => $request->input('section')]
            ]);

        return response()->json([

            'url' => $file['link']
        ]);

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->retrieve(File::all()) ;
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
    public function destroy(Request $request, File $file)
    {

        DB::transaction(function () use ($request, $file) {
            $model = modelResolve($request->fileable_type);
            if ($request->filled('fileable_id') and $model)
                $model::find($request->input('fileable_id'))->files()->detach($file->id);
            $file->delete();

        });

        return $this->deletedResponse();
    }

    public function download(Request $request, File $file)
    {
        return response()->file(storage_path($file->path));
    }
}
