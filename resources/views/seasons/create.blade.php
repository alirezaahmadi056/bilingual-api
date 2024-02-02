@extends('layouts.master')

@section('Title')
افزودن فصل
@endsection

@section('content')
<div class="flex justify-center items-center mt-20">
    <form class="flex flex-col gap-5" action="{{ route("seasons.store") }}" method="POST">
        @csrf
        <input name="title" type="text" class=" rounded-md border-[#B2B2B2]" placeholder="تایتل">
        <input name="count" type="number" class=" rounded-md border-[#B2B2B2]" placeholder="تعداد ویدیو">
        <select name="course" id="" class=" rounded-md border-[#B2B2B2]">
            @foreach ($courses as $course)
                <option value="{{ $course->id }}">{{ $course->name }}</option>
            @endforeach
        </select>
        <label for="video">ویدیو:</label>
        <input name="video" type="file" class=" rounded-md border-[#B2B2B2]">
        <button type="submit" class="bg-primary w-full text-[#FFFFFF] text-xl py-2 rounded-xl">ثبت</button>
    </form>
</div>
@endsection
