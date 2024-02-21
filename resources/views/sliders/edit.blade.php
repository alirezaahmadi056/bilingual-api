@extends('layouts.master')

@section('Title')
ثبت اسلایدر
@endsection

@section('content')
<div class="flex justify-center items-center mt-20">
    <form class="flex flex-col gap-y-10" action="{{ route("sliders.update",$slider->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <img src="{{ asset("slider_image/".$slider->image) }}" class="w-96 rounded-xl shadow-2xl" alt="">
        <input type="hidden" name="beforeimage" value="{{ $slider->image }}">
        <div class="flex flex-col gap-3">
            <label for="link">لینک</label>
            <select name="link" id="" class="border-[1px] border-[#B2B2B2] rounded-xl py-3 px-8">
                @foreach ($pages as $page)
                <option value="{{ $page->inapp }}">{{ $page->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex flex-col gap-3">
            <label for="Upload">تصویر</label>
            <input name="image" type="file">
        </div>
        <div class="flex justify-center items-center">
            <button type="submit" class="bg-[#5D001E] rounded-md text-[#FFFFFF] p-3 flex items-center gap-2"><img src="./Icon/gallery-add.svg" alt="">ثبت اسلایدر</button>
        </div>
    </form>
</div>
@endsection
