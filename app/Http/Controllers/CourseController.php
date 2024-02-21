<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Faker\Core\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File as FacadesFile;

class CourseController extends Controller
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
        return view("courses.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fileName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('courses_image'), $fileName);

        Course::create([
            "name" => $request->name,
            "teacher_name" => $request->teacher_name,
            "description" => $request->description,
            "price" => $request->price,
            "percent" => $request->percent,
            "hour" => $request->hour,
            "spot_id" => $request->spot_id,
            "image" => $fileName,
        ]);

        return redirect("/");
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
    public function destroy(Course $course)
    {
        $image_path = public_path("courses_image/$course->image");
        FacadesFile::delete($image_path);
        $course->delete();
        return back();
    }
}
