<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Episode;
use App\Models\Seasons;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $file = $request->file('video');
        $filename = $file->getClientOriginalName();
        $path = public_path() . '/Episodes/';
        $file->move($path, $filename);

        Episode::create([
            "title" => $request->title,
            "season_id" => $request->season,
            "video" => $filename,
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $course = Course::findOrFail($id);
        $seasons = $course->seasons;
        return view("episode.create", compact("seasons"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Episode $episode)
    {
        $image_path = public_path("Episodes/$episode->video");
        if(File::exists($image_path)) {
            File::delete($image_path);
        }
        $episode->delete();
        return back();
    }
}
