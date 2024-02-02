<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Slider::all();
        return view("sliders.index",compact("sliders"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("sliders.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fileName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('slider_image'), $fileName);

        Slider::create([
            "link" => $request->link,
            "image" => $fileName,
        ]);

        return redirect(route("sliders.index"));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slider $slider)
    {
        return view("sliders.edit",compact("slider"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Slider $slider)
    {
        $fileName = null;

        if($request->image){
            $image_path = public_path("slider_image/$request->beforeimage");
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
            $fileName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('slider_image'), $fileName);
        }

        $slider->update([
            'link' => $request->link,
            "image" => $fileName != null ? $fileName : $request->beforeimage
        ]);

        return redirect(route('sliders.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        $slider->delete();
        $image_path = public_path("slider_image/$slider->image");
        File::delete($image_path);
        return back();
    }
}
