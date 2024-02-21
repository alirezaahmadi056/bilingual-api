@extends('layouts.master')

@section('Title')
افزودن فصل
@endsection

@section('content')
<div class="flex justify-center items-center mt-20">
    <form class="flex flex-col gap-5" action="{{ route("seasons.store") }}" method="POST">
        @csrf
        <input type="hidden" name="course_id" value="{{ $id }}">
        <input name="title" type="text" class=" rounded-md border-[#B2B2B2]" placeholder="تایتل">
        <button type="submit" class="bg-primary w-full text-[#FFFFFF] text-xl py-2 rounded-xl">ثبت</button>
    </form>
</div>
@endsection
