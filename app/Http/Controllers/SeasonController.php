<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Seasons;
use Illuminate\Http\Request;

class SeasonController extends Controller
{
    public function index(string $id){
        $course = Course::findOrFail($id);
        $seasons = $course->seasons;
        return view("season",compact(["seasons","id"]));
    }

    public function create(string $id){
        $courses = Course::all();
        return view("seasons.create",compact("courses","id"));
    }

    public function store(Request $request){
        Seasons::create([
            "title" => $request->title,
            "course_id" => $request->course_id,
            "count_video" => $request->count,
        ]);

        return redirect(route("seasons.index",$request->course_id));
    }

    public function destroy(string $id){
        $seasons = Seasons::findOrFail($id);
        $seasons->delete();
        return back();
    }
}
