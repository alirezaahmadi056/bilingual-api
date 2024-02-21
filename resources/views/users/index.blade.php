@extends('layouts.master')

@section('Title')
کاربران
@endsection

@section('content')
<div class="container mx-auto mt-10 flex flex-col gap-8 max-sm:px-3">
    <form action="{{ route("users.index") }}" class="flex items-cemter">
        <input name="search" type="text" class="rounded-tr-xl rounded-br-xl border-[1px] border-[#B2B2B2] py-2 px-3" placeholder="جستجو">
        <div class="bg-primary flex items-center justify-center rounded-tl-xl rounded-bl-xl px-3">
            <button type="submit"><i class="fa-solid fa-magnifying-glass text-[#FFF]"></i></button>
        </div>
    </form>
    <table class="">
        <thead class="bg-[#B2B2B2] bg-opacity-30 sticky top-0">
            <tr>
                <th class="py-3">نام</th>
                <th class="py-3">شماره</th>
                <th class="py-3">ایمیل</th>
                <th class="py-3">تاریخ تولد</th>
                <th class="py-3">عملیات</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr class="border-[1px] border-[#B2B2B2]">
                <td class="text-center py-3">{{ $user->name == null ? "بی نام" : $user->name }}</td>
                <td class="text-center py-3">{{ $user->phone }}</td>
                <td class="text-center py-3">{{ $user->email }}</td>
                <td class="text-center py-3">{{ \Morilog\Jalali\Jalalian::forge($user->birthday)->format('%B %d، %Y'); }}</td>
                <td class="flex justify-center py-3">
                    <button class="bg-primary text-[#FFFFFF] max-sm:text-lg text-lg p-2 rounded-xl max-sm:mt-3"><a href="{{ route("users.show",$user->id) }}">دوره‌ های خریداری شده</a></button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{-- @foreach ($users as $user)
        <div class="bg-[#F9F9F9] px-4 py-3 rounded-md max-sm:block flex justify-between items-center border-[1px] border-[#B2B2B2] max-sm:max-w-full">
            <div class="flex justify-between w-full lg:px-5">
                <h1 class="text-xl font-bold">{{ $user->name }}</h1>
                <span>شماره تلفن:{{ $user->phone }}</span>
                <span>ایمیل:{{ $user->email }}</span>
                <span class="max-sm:hidden">تاریخ تولد:{{ \Morilog\Jalali\Jalalian::forge($user->birthday)->format('%B %d، %Y'); }}</span>
            </div>
            <button class="bg-primary w-60 text-[#FFFFFF] max-sm:text-lg text-xl py-2 rounded-xl max-sm:mt-3"><a href="{{ route("users.show",$user->id) }}">دوره‌ های خریداری شده</a></button>
        </div>
    @endforeach --}}
</div>
@endsection
