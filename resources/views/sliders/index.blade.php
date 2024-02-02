@extends('layouts.master')

@section('Title')
اسلایدر
@endsection

@section('content')
<div class="flex justify-center items-center">
    <button class="rounded-xl px-4 py-2 flex items-center text-primary text-xl border-[1px] border-primary my-8"><img src="./Icon/add.svg" alt=""><a href="{{ route("sliders.create") }}">ثبت اسلایدر</a></button>
</div>
<div class="flex justify-center items-center gap-10 flex-wrap">
    @foreach ($sliders as $slider)
        <div class="w-80 border-[2px] border-[#b2b2b2] rounded-3xl">
            <img src="{{ asset("slider_image/".$slider->image) }}" alt="" class="rounded-tl-3xl rounded-tr-3xl">
            <div class="px-6 py-3 flex flex-col gap-5">
                <p>{{ $slider->link }}</p>
                <div class="flex items-center gap-3">
                    <button class="flex basis-2/4 justify-center items-center bg-primary w-full text-[#FFFFFF] text-[14px] py-2 rounded-xl"><img class="w-[16px] ml-2" src="{{ asset("Icon/edit-2.svg") }}" alt=""><a href="{{ route("sliders.edit",$slider->id) }}">ویرایش</a></button>
                    <form class="basis-2/4 mt-4" action="{{ route("sliders.destroy",$slider->id) }}" method="post">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="flex justify-center items-center w-full text-primary text-[14px] py-2 rounded-xl"><img class="w-[16px] ml-2" src="{{ asset("Icon/trash-1.svg") }}" alt="">حذف</button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
