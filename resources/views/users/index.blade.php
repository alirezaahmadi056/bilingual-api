@extends('layouts.master')

@section('Title')
کاربران
@endsection

@section('content')
<div class="container mx-auto mt-10 flex flex-col gap-8">
    <div class="bg-[#F9F9F9] px-4 py-3 rounded-md flex justify-between items-center border-[1px] border-[#B2B2B2]">
        <h1 class="text-xl font-bold">علیرضا احمدی</h1>
        <span>شماره تلفن:09034293242</span>
        <span>ایمیل:seyeedm0@gmail.com</span>
        <span>تاریخ تولد:1402/4/5</span>
        <button class="bg-primary w-60 text-[#FFFFFF] text-xl py-2 rounded-xl"><a href="{{ route("users.show",1) }}">دوره‌ های خریداری شده</a></button>
    </div>
</div>
@endsection
