@extends('layouts.master')

@section('Title')
مقالات
@endsection

@section('content')
<div class="flex justify-center items-center">
    <button class="rounded-xl px-4 py-2 flex items-center text-primary text-xl border-[1px] border-primary my-8"><img src="./Icon/add.svg" alt="">ثبت مقاله</button>
</div>
<div class="flex justify-center items-center gap-10 flex-wrap">
    <div class="w-80 border-[2px] border-[#b2b2b2] rounded-3xl">
        <img src="./Img/1.png" alt="" class="rounded-tl-3xl rounded-tr-3xl">
        <div class="px-6 py-3 flex flex-col gap-5">
            <h1 class="text-2xl text-center font-bold">دوره جامع زبان انگلیسی</h1>
            <p>Mollitia, unde. Doloremque, rerum architecto. Error nesciunt dolore iusto aliquid hic?</p>
            <div class="flex items-center gap-3">
                <button class="flex justify-center items-center bg-primary w-full text-[#FFFFFF] text-[14px] py-2 rounded-xl"><img class="w-[16px] ml-2" src="./Icon/edit-2.svg" alt="">ویرایش</button>
                <button class="flex justify-center items-center w-full text-primary text-[14px] py-2 rounded-xl"><img class="w-[16px] ml-2" src="./Icon/trash-1.svg" alt="">حذف</button>
            </div>
        </div>
    </div>
</div>
@endsection
