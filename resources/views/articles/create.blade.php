@extends('layouts.master')

@section('Title')
افزودن مقاله
@endsection

@section('content')
<div class="flex justify-center items-center mt-20">
    <form class="flex flex-col gap-5" action="{{ route("articles.store") }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input name="title" type="text" class=" rounded-md border-[#B2B2B2]" placeholder="تایتل">
        <textarea name="description" id="" cols="30" rows="10" class=" rounded-md border-[#B2B2B2]" placeholder="توضیخات"></textarea>
        <label for="image">عکس:</label>
        <input type="file" name="image" id="">
        <button type="submit" class="bg-primary w-full text-[#FFFFFF] text-xl py-2 rounded-xl">ثبت</button>
    </form>
</div>
@endsection
