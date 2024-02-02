@extends('layouts.master')

@section('Title')
ثبت اسلایدر
@endsection

@section('content')
<div class="flex justify-center items-center mt-20">
    <form class="flex flex-col gap-y-10" action="" method="post" enctype="multipart/form-data">
        <div class="flex flex-col gap-3">
            <label for="Upload">تصویر</label>
            <input type="file">
        </div>
        <div class="flex flex-col gap-3">
            <label for="link">لینک</label>
            <input type="text" class="border-[1px] border-[#B2B2B2] rounded-xl py-3 px-4">
        </div>
        <div class="flex justify-center items-center">
            <button type="submit" class="bg-[#5D001E] rounded-md text-[#FFFFFF] p-3 flex items-center gap-2"><img src="./Icon/gallery-add.svg" alt="">ثبت اسلایدر</button>
        </div>
    </form>
</div>
@endsection
