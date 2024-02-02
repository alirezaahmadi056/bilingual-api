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
        <div class="w-80 border-[2px] border-[#b2b2b2] rounded-3xl">
            <img src="{{ asset("courses_image/".$course->image) }}" alt="" class="rounded-tl-3xl rounded-tr-3xl">
            <div class="px-6 py-3 flex flex-col gap-5">
                <h1 class="text-2xl text-center font-bold">{{ $course->name }}</h1>
                <span>قیمت: {{ $course->price }} تومان</span>
                <p>{{ $course->description }}</p>
                <button class="bg-primary w-full text-[#FFFFFF] text-xl py-2 rounded-xl"><a href="{{ route("season.index",$course->id) }}">جزییات</a></button>
            </div>
        </div>
    @endforeach
</div>
@endsection
