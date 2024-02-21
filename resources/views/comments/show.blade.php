@extends('layouts.master')

@section('Title')
کامنت های دوره {{ $name }}
@endsection

@section('content')
<div class="flex items-center justify-center mt-20 gap-7 max-sm:flex-col">
    @foreach ($comments as $comment)
        <div class=" shadow-lg rounded-md py-3 px-5 w-64 border-[1px] border-[#B2B2B2] flex flex-col">
            <h1 class="text-xl">نام کاربر:{{ $comment->title }}</h1>
            <h1 class="mt-2">امتیاز:<span>{{ $comment->points }}</span></h1>
            <p class="mt-2">متن:<span>{{ $comment->description }}</span></p>
            <div class="flex items-center gap-3 mt-3">
                <form action="{{ route("comment.update",$comment->id) }}" method="post" class="basis-2/4">
                    @csrf
                    @method("PUT")
                    <button class="bg-primary basis-2/4 rounded-md py-2 w-full text-[#FFFFFF]">تایید</button>
                </form>
                <form class=" basis-2/4" action="{{ route("comment.destroy",$comment->id) }}" method="post">
                    @csrf
                    @method("DELETE")
                    <button type="submit" class="border-[1px] border-primary py-2 w-full rounded-md">حذف کردن</button>
                </form>
            </div>
            <button class="bg-primary rounded-md py-2 w-full text-[#FFFFFF]"><a href="{{ route("comment.edit",$comment->id) }}">ویرایش</a></button>
        </div>
    @endforeach
</div>
@endsection
