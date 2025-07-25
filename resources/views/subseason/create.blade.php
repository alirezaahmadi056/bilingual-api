@extends('layouts.master')

@section("Title")
افزودن زیرفصل
@endsection

@section("content")
<div class="flex justify-center items-center mt-20">
    <form class="flex flex-col gap-5 w-80" action="{{ route("seasons.sub.store") }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input name="title" type="text" class=" rounded-md border-[#B2B2B2]" placeholder="تایتل">
        <div class="flex flex-col gap-2">
            <label for="season">فصل مورد نظر:</label>
            <select name="season" id="" class=" rounded-md border-[#B2B2B2]">
                @foreach ($seasons as $season)
                    <option value="{{ $season->id }}">{{ $season->title }}</option>
                @endforeach
            </select>
        </div>
        <button id="success" type="submit" onclick="PleaseWait()" class="bg-primary w-full text-[#FFFFFF] text-xl py-2 rounded-xl">ثبت</button>
    </form>
</div>
@endsection

@section('js')
<script>
    function PleaseWait() {
      document.getElementById("success").innerHTML = "لطفا صبر کنید ...";
    }
    </script>
@endsection
