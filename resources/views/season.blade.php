@extends('layouts.master')

@section('Title')
فصل ها
@endsection

@section('content')
<div class="flex justify-center items-center gap-3">
    <button class="rounded-xl px-4 py-2 flex items-center text-primary max-sm:text-sm text-xl border-[1px] border-primary my-8"><img src="{{ asset("Icon/add.svg") }}" alt=""><a href="{{ route("seasons.create",$id) }}">افزودن فصل</a></button>
    <button class="border-primary border-[1px] py-2 px-4 flex justify-center items-center gap-1 text-xl rounded-xl text-primary"><img src="{{ asset("/Icon/add.svg") }}" alt=""><a href="{{ route("seasons.sub.create",$editid) }}">افزودن زیرفصل</a></button>
    <button class="border-[1px] border-primary py-2 px-4 flex justify-center max-sm:text-sm text-xl items-center gap-2 rounded-xl text-primary"><img src="{{ asset("/Icon/video-add.svg") }}" alt=""><a href="{{ route("episodes.show",$editid) }}">آپلود ویدیو</a></button>
</div>
<div class="container mx-auto flex flex-col justify-center items-center">
    @foreach ($seasons as $season)
    <div class="bg-[#F9F9F9] px-4 py-3 rounded-tl-xl mt-5 rounded-tr-xl w-[52rem] max-sm:w-96 flex justify-between items-center border-[1px] border-[#B2B2B2]">
        <h1 class="text-xl font-bold">{{ $season->title }}</h1>
        <div class="flex justify-center items-center gap-5">
            <form action="{{ route("seasons.destroy",$season->id) }}" method="post" class=" mt-4">
                @csrf
                @method("DELETE")
                <button class="bg-primary py-2 px-4 flex justify-center items-center gap-2 rounded-md text-[#FFFFFF]"><img src="{{ asset("/Icon/trash.svg") }}" alt="">حذف</button>
            </form>
        </div>
    </div>

    <ul class=" w-[52rem] max-sm:w-96 border-[1px] border-[#B2B2B2] rounded-bl-xl rounded-br-xl">
        @foreach ($season->episodes as $episode)
            <li class="px-12">
                <div class="flex justify-between py-7 px-4 border-b-[1px] border-[#B2B2B2]">
                    <h1>{{ $episode->title }}</h1>
                    <form action="{{ route("episodes.destroy",$episode->id) }}" method="post">
                        @csrf
                        @method("DELETE")
                        <button class="flex items-center gap-1 text-primary"><img class="w-[20px]" src="{{ asset("Icon/trash-1.svg") }}" alt="">حذف</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
    @endforeach
</div>
@endsection
