<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Course;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::all();
        return view("comments.index",compact("courses"));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $course = Course::findOrFail($id);
        $comments = Comment::where("course_id",$course->id)->where("is_ok",0)->get();
        $name = $course->name;
        return view("comments.show",compact(["comments","name"]));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        return view("comments.edit",compact("comment"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        if(isset($request->description)){
            $comment->update([
                "is_ok" => 1,
                "description" => $request->description
            ]);
        }else{
            $comment->update([
                "is_ok" => 1
            ]);
        }

        return redirect(route("comment.show",$comment->id));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back();
    }
}
