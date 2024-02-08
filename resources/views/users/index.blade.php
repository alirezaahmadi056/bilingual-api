@extends('layouts.master')

@section('Title')
کاربران
@endsection

@section('content')
<div class="container mx-auto mt-10 flex flex-col gap-8 max-sm:px-3">
    @foreach ($users as $user)
        <div class="bg-[#F9F9F9] px-4 py-3 rounded-md max-sm:block flex justify-between items-center border-[1px] border-[#B2B2B2] max-sm:max-w-full">
            <div class="flex justify-between w-full lg:px-5">
                <h1 class="text-xl font-bold">{{ $user->name }}</h1>
                <span>شماره تلفن:{{ $user->phone }}</span>
                <span>ایمیل:{{ $user->phone }}</span>
                <span class="max-sm:hidden">تاریخ تولد:{{ \Morilog\Jalali\Jalalian::forge($user->birthday)->format('%B %d، %Y'); }}</span>
            </div>
            <button class="bg-primary w-60 text-[#FFFFFF] max-sm:text-lg text-xl py-2 rounded-xl max-sm:mt-3"><a href="{{ route("users.show",$user->id) }}">دوره‌ های خریداری شده</a></button>
        </div>
    @endforeach
</div>
@endsection
