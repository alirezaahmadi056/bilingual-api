@extends('layouts.master')

@section('Title')
دروره ها
@endsection

@section('content')
<div class="flex justify-center items-center">
    <button class="rounded-xl px-4 py-2 flex items-center text-primary text-xl border-[1px] border-primary my-8"><img src="{{ asset("Icon/add.svg") }}" alt=""><a href="{{ route("courses.create") }}">ثبت دوره</a></button>
</div>
<div class="flex justify-center items-center gap-10 flex-wrap">
    @foreach ($courses as $course)
        <div class="w-80 border-[2px] border-[#b2b2b2] rounded-3xl h-[34rem] flex flex-col justify-between">
            <img src="{{ asset("courses_image/".$course->image) }}" alt="" class=" h-60 object-cover rounded-tl-3xl rounded-tr-3xl">
            <div class="px-6 py-3 flex flex-col gap-5">
                <h1 class="text-2xl text-center font-bold">{{ $course->name }}</h1>
                <span>قیمت: {{ $course->price }} تومان</span>
                <p><span class="text-lg ml-2">شناسه دوره:</span>{{ substr_replace($course->spot_id, "...", 25) }}</p>
                <p class="text-[#3f3f3f]">توضیحات:{{ substr_replace($course->description, "...", 20) }}</p>
                <div class="flex items-center justify-between gap-3">
                    <form class="basis-2/4 mt-4" action="{{ route("courses.destroy",$course->id) }}" method="post">
                        @csrf
                        @method("DELETE")
                        <button class="border-[1px] border-primary w-full text-xl py-2 rounded-xl">حذف</button>
                    </form>
                    <button class="bg-primary basis-2/4 w-full text-[#FFFFFF] text-xl py-2 rounded-xl"><a href="{{ route("seasons.index",$course->id) }}">فصل ها</a></button>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
