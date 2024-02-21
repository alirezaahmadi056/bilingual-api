@extends('layouts.master')

@section('Title')
ویرایش مقاله
@endsection

@section('content')
<div class="flex justify-center items-center mt-20">
    <form class="flex flex-col gap-5" action="{{ route("articles.update",$article->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <img src="{{ asset("article_image/".$article->image) }}" class="w-96 rounded-xl shadow-2xl" alt="">
        <input type="hidden" name="beforeimage" value="{{ $article->image }}">
        <input name="title" type="text" class=" rounded-md border-[#B2B2B2]" placeholder="تایتل" value="{{ $article->title }}">
        <textarea name="description" id="editor" cols="30" rows="10" class=" rounded-md border-[#B2B2B2]" placeholder="توضیخات">{{ $article->description }}</textarea>
        <label for="image">عکس:</label>
        <input type="file" name="image" id="">
        <button type="submit" class="bg-primary w-full text-[#FFFFFF] text-xl py-2 rounded-xl">ثبت</button>
    </form>
</div>
@endsection

@section('js')
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
@endsection
