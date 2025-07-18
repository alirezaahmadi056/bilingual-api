@extends('layouts.master')

@section('Title')
افزودن دوره
@endsection

@section('content')
    <div class="flex justify-center items-center mt-20">
        <form class="flex flex-col gap-5 w-[30rem]" action="{{ route("courses.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input name="name" type="text" class=" rounded-md border-[#B2B2B2]" placeholder="نام دوره">
            <input name="teacher_name" type="text" class=" rounded-md border-[#B2B2B2]" placeholder="نام مدرس">
            <input onkeypress="Seprat()" name="price" type="number" class="price rounded-md border-[#B2B2B2]" placeholder="قیمت (تومان)">
            <input name="percent" type="number" class=" rounded-md border-[#B2B2B2]" placeholder="تخفیف (اختیاری,درصد)">
            <input name="hour" type="number" class=" rounded-md border-[#B2B2B2]" placeholder="ساعت">
            <input name="spot_id" type="text" class=" rounded-md border-[#B2B2B2]" placeholder="شناسه دوره در اسپات پلیر">
            <textarea name="description" class=" rounded-md border-[#B2B2B2]" id="" cols="30" rows="10" placeholder="توضیحات"></textarea>
            <label for="image">عکس:</label>
            <input name="image" type="file" class=" rounded-md border-[#B2B2B2]">
            <button type="submit" class="bg-primary w-full text-[#FFFFFF] text-xl py-2 rounded-xl">ثبت</button>
        </form>
    </div>
@endsection
@section('js')
    <script>
        function Seprat(){
            var price = document.querySelector(".price").value;
            console.log(price.toLocaleString());
        }
    </script>
@endsection
