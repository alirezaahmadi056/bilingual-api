@extends('layouts.master')

@section('content')
<div class="flex justify-center items-center mt-20">
    <form class="flex flex-col gap-y-10" action="{{ route("comment.update",$comment->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <div class="flex flex-col gap-3">
            <label for="link">متن کامنت</label>
            <textarea name="description" type="text" class="border-[1px] border-[#B2B2B2] rounded-xl py-3 px-4">{{ $comment->description }}</textarea>
        </div>
        <div class="flex justify-center items-center">
            <button type="submit" class="bg-[#5D001E] rounded-md text-[#FFFFFF] p-3 flex items-center gap-2"><img src="./Icon/gallery-add.svg" alt="">تایید کامنت</button>
        </div>
    </form>
</div>
@endsection
