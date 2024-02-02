@extends('layouts.master')

@section('Title')
کاربران
@endsection

@section('content')
<div class="container mx-auto mt-10 flex flex-col gap-8">
    @foreach ($users as $user)
        <div class="bg-[#F9F9F9] px-4 py-3 rounded-md flex justify-between items-center border-[1px] border-[#B2B2B2]">
            <h1 class="text-xl font-bold">{{ $user->name }}</h1>
            <span>شماره تلفن:{{ $user->phone }}</span>
            <span>ایمیل:{{ $user->phone }}</span>
            <span>تاریخ تولد:{{ \Morilog\Jalali\Jalalian::forge($user->birthday)->format('%B %d، %Y'); }}</span>
            <button class="bg-primary w-60 text-[#FFFFFF] text-xl py-2 rounded-xl"><a href="{{ route("users.show",$user->id) }}">دوره‌ های خریداری شده</a></button>
        </div>
    @endforeach
</div>
@endsection
