<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\File;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Str;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->retrieve(Setting::with('file')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storfe(Request $request)
    {
        $file = $request->file('file');
        dd($file);

        $request->apiValidate([
            'key' => 'required',
            'value' => 'required',

        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting)
    {
        $validator = $request->apiValidate([
            'file_id' => 'nullable'
        ]);
        $setting->update($validator->validated());
        return $this->updatedResponse($setting);
    }

    public function upload(Request $request, Setting $setting)
    {
        $file = $request->file('file');
        $name = Str::random(10) . '-' . Carbon::now() . '.' . $file->guessClientExtension();
        $path = $file->storeAs('settings', $name);

        $file = File::create([
            'path' => 'app/' . $path,
            'extension' => $file->guessClientExtension(),
            'size' => $file->getSize(),
            'mime_type' => $file->getMimeType(),
            'fileable_id' => $setting->id,
            'fileable_type' => Setting::class,
        ]);

        $setting->update(['file_id' => $file->id]);
        return $this->response('فایل با موفقیت بارگزاری شد', $setting->refresh()->load('file'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
