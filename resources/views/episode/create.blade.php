@extends('layouts.master')

@section("Title")
آپلود ویدیو
@endsection

@section("content")
<div class="flex justify-center items-center mt-20">
    <form class="flex flex-col gap-5" action="{{ route("episodes.store") }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input name="title" type="text" class=" rounded-md border-[#B2B2B2]" placeholder="تایتل">
        <select name="season" id="" class=" rounded-md border-[#B2B2B2]">
            @foreach ($seasons as $season)
                <option value="{{ $season->id }}">{{ $season->title }}</option>
            @endforeach
        </select>
        <label for="video">ویدیو:</label>
        <input name="video" type="file" class=" rounded-md border-[#B2B2B2]">
        <button type="submit" class="bg-primary w-full text-[#FFFFFF] text-xl py-2 rounded-xl">ثبت</button>
    </form>
</div>
@endsection
