@extends('layouts.master')

@section("Title")
کامنت ها
@endsection

@section('content')
<div class="flex justify-center items-center gap-10 flex-wrap mt-20">
    @foreach ($courses as $course)
    @php
        $comment = App\Models\Comment::where("course_id",$course->id)->where("is_ok",0)->get()
    @endphp
        <div class="w-80 border-[2px] border-[#b2b2b2] rounded-3xl h-[26rem] flex flex-col justify-between">
            <img src="{{ asset("courses_image/".$course->image) }}" alt="" class="rounded-tl-3xl rounded-tr-3xl h-48">
            <div class="px-6 py-3 flex flex-col gap-8">
                <h1 class="text-2xl text-center font-bold">{{ $course->name }}</h1>
                <p class="text-xl"><span class="text-lg ml-2"> تعداد کامنت ها:</span>{{ $comment->count() }}</p>
                <button class="bg-primary w-full text-[#FFFFFF] text-xl py-2 rounded-xl"><a href="{{ route("comment.show",$course->id) }}">کامنت ها</a></button>
            </div>
        </div>
    @endforeach
</div>
@endsection
