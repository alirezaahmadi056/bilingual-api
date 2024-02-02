<html lang="IR-fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset("css/style.css") }}">
    @vite('resources/css/app.css')
    <title>بیلینگول</title>
</head>
<body>
    <section class="h-screen flex">
        <aside class="w-64 max-sm:hidden bg-[#F1F1F1] h-[100vh] border-l-[1px] border-opacity-30 border-[#B2B2B2]">
            <div class="flex items-center justify-center py-7 px-3">
                <a href="{{ route("home") }}">
                    <img class="w-48" src="{{ asset("Img/Vector.svg") }}" alt="">
                </a>
            </div>
            <ul class="mt-12 py-5">
                <li class="flex px-10">
                    <img class="w-7" src="@if(Route::is("home")) {{ asset("Icon/book.svg") }} @else {{ asset("Icon/book - 2.svg") }} @endif" alt="">
                    <a href="{{ route("home") }}" class="text-xl mr-5 text-[#686868] @if(Route::is("home")) text-primary @endif">دروه ها</a>
                </li>
                <li class="flex mt-12 px-10">
                    <img class="w-7" src="@if(Route::is("users.index")) {{ asset("Icon/people.svg") }} @else {{ asset("Icon/people - 2.svg") }} @endif" alt="">
                    <a href="{{ route("users.index") }}" class="text-xl mr-5 text-[#686868] @if(Route::is("users.index")) text-primary @endif">کاربران</a>
                </li>
                <li class="flex mt-12 px-10">
                    <img class="w-7" src="@if(Route::is("articles.index")) {{ asset("Icon/book-square.svg") }} @else {{ asset("Icon/book-square - 2.svg") }} @endif" alt="">
                    <a href="{{ route("articles.index") }}" class="text-xl mr-5 text-[#686868] @if(Route::is("articles.index")) text-primary @endif">مقالات</a>
                </li>
                <li class="flex mt-12 px-10">
                    <img class="w-7" src="@if(Route::is("sliders.index")) {{ asset("Icon/image.svg") }} @else {{ asset("Icon/image - 2.svg") }} @endif" alt="">
                    <a href="{{ route("sliders.index") }}" class="text-xl mr-5 text-[#686868] @if(Route::is("sliders.index")) text-primary @endif">اسلایدر</a>
                </li>
            </ul>
        </aside>
        <div class="flex-1">
            <nav class=" lg:hidden bg-white py-7 px-3 flex items-center justify-between">
                <a href="" class=" border-l-2 border-opacity-50 border-mblue">
                    <img class=" w-24" src="" alt="">
                </a>
                <ul class="flex items-center gap-3">
                    <li class="flex items-center justify-center">
                        <img class="w-8" src="" alt="">
                        <a href="" class="text-base mr-3 font-bold">نگهبانان</a>
                    </li>
                    <li class="flex items-center justify-center">
                        <img class="w-8" src="" alt="">
                        <a href="" class="text-base mr-3 font-bold">اتاق ها</a>
                    </li>
                </ul>
                <form action="" method="POST" class="flex items-center justify-center">
                    <button type="submit"><img class="w-18" src="" alt=""></button>
                </form>
            </nav>
            <nav class="py-8 px-14 max-sm:hidden bg-white border-b-[1px] border-[#B2B2B2] border-opacity-30 w-full left-0 h-min flex items-center justify-between">
                <h1 class="text-3xl font-bold text-mblue">@yield('Title')</h1>
                <form action="" method="POST" class="flex items-center justify-center">
                    <img src="{{ asset("Icon/logout_svgrepo.com.svg") }}" alt="Logout">
                    <button type="submit" class="text-2xl font-bold text-primary mr-2">خروج از حساب</button>
                </form>
            </nav>
            <div class="main">
                @yield('content')
            </div>
        </div>
    </section>
</body>
</html>
