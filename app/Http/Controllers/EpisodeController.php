<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Seasons;
use Illuminate\Http\Request;

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
        $seasons = Seasons::all();
        return view("episode.create",compact("seasons"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $videoFile = $request->file('video');
        $fileName = time() . '.' . $videoFile->getClientOriginalName();
        $videoFile->storeAs(public_path('Episodes'), $fileName);
        //$request->video->move(public_path('Episodes'), $fileName);

        Episode::create([
            "title" => $request->title,
            "season_id" => $request->season,
            "video" => $fileName,
        ]);

        return back();
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
        $episode->delete();
        return back();
    }
}
