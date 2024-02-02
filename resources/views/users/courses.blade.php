@extends('layouts.master')

@section('Title')
دروه های خریداری شده (علیرضا احمدی)
@endsection

@section('content')
<div class="flex justify-center items-center gap-10 flex-wrap mt-10">
    <div class="w-80 border-[2px] border-[#b2b2b2] rounded-3xl">
        <img src="{{ asset("Img/1.png") }}" alt="" class="rounded-tl-3xl rounded-tr-3xl">
        <div class="px-6 py-3 flex flex-col gap-5">
            <h1 class="text-2xl text-center font-bold">دوره جامع زبان انگلیسی</h1>
            <span>قیمت: 26000 تومان</span>
            <p>Mollitia, unde. Doloremque, rerum architecto. Error nesciunt dolore iusto aliquid hic?</p>
        </div>
    </div>
</div>
@endsection
