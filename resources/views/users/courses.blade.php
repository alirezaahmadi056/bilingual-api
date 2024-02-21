@extends('layouts.master')

@section('Title')
دروه های خریداری شده {{ $name }}
@endsection

@section('content')
<div class="flex justify-center items-center gap-10 flex-wrap mt-10">
    @foreach ($carts as $cart)
        @foreach ($cart->course as $course)
        <div class="w-80 border-[2px] border-[#b2b2b2] rounded-3xl">
            <img src="{{ asset("Img/1.png") }}" alt="" class="rounded-tl-3xl rounded-tr-3xl">
            <div class="px-6 py-3 flex flex-col gap-5">
                <h1 class="text-2xl text-center font-bold">{{ $course->name }}</h1>
                <span>قیمت: {{ $course->price }} تومان</span>
                <span>وضعیت: @if($cart->status == 1) پرداخت شده @else پرداخت نشده @endif </span>
                <p class="border-[1px] border-primary rounded-md py-2 px-3 text-center">لایسنس: {{ $cart->license }}</p>
            </div>
        </div>
        @endforeach
    @endforeach
</div>
@endsection
