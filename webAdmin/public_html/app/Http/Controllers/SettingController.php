<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::first();
        return view('setting.index', compact('setting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $validated = $request->validate([
            'support_email' => 'required|email',
            'android_version' => 'required',
            'disclaimer' => 'required',
            'ios_version' => 'required',
            'cover_image' => 'mimes:jpg,png,jpeg',
            'image_url' => 'url',
        ]);

        $setting = Setting::first();

        if ($setting) {
            if ($request->hasFile('cover_image')) {
                $image = $request->file('cover_image');
                $imageName = time() . "." . $image->extension();
                $setting->cover_image = $imageName;
                if ($setting->cover_image) {
                    $path = public_path('uploads/'.$setting->cover_image);
                    unlink($path);
                    // unlink("uploads/" . $setting->cover_image);
                    $image->move(public_path('uploads'), $imageName);
                } else {
                    $image->move(public_path('uploads'), $imageName);
                }
            }

            $setting->support_email = $validated['support_email'];
            $setting->disclaimer = $validated['disclaimer'];
            
            $setting->android_version = $validated['android_version'];
            $setting->ios_version = $validated['ios_version'];
            $setting->image_url = $validated['image_url'];
            
            $setting->save();

            toastr()->success("Setting are updated successfully");
            return redirect()->back();
        } else {
            if ($request->hasFile('cover_image')) {
                $image = $request->file('cover_image');
                $imageName = time() . "." . $image->extension();
                $image->move(public_path('uploads'), $imageName);
                $validated['cover_image'] = $imageName;
            }
            Setting::create($validated);

            toastr()->success("Setting are updated successfully");
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
