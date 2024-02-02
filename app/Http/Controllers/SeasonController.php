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
        return view("season",compact("seasons"));
    }

    public function create(){
        $courses = Course::all();
        return view("seasons.create",compact("courses"));
    }

    public function store(Request $request){

    }

    public function destroy(string $id){
        $seasons = Seasons::findOrFail($id);
        $seasons->delete();
        return back();
    }
}
