<html lang="IR-fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset("css/style.css") }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
    @vite('resources/css/app.css')
    <title>Bilingual</title>
</head>
<body class="max-sm:relative">
    <section class="h-screen flex">
        <aside class="w-64 max-sm:hidden bg-[#F1F1F1] h-[100vh] border-l-[1px] border-opacity-30 border-[#B2B2B2]">
            <div class="flex items-center justify-center py-7 px-3">
                <a href="{{ route("home") }}">
                    <img class="w-48" src="{{ asset("Img/Vector.svg") }}" alt="">
                </a>
            </div>
            <ul class="mt-12 py-5">
                <li class="flex px-10">
                    <img class="w-7" src="@if(Route::is("home") || Route::is("courses.create") || Route::is("courses.edit") || Route::is("seasons.edit") || Route::is("seasons.index") || Route::is("seasons.edit") || Route::is("seasons.create")) {{ asset("Icon/book.svg") }} @else {{ asset("Icon/book - 2.svg") }} @endif" alt="">
                    <a href="{{ route("home") }}" class="text-xl mr-5 text-[#686868] @if(Route::is("home") || Route::is("courses.create") || Route::is("courses.edit") || Route::is("seasons.edit") || Route::is("seasons.index") || Route::is("seasons.edit") || Route::is("seasons.create")) text-primary @endif">دروه ها</a>
                </li>
                <li class="flex mt-12 px-10">
                    <img class="w-7" src="@if(Route::is("users.index") || Route::is("users.show")) {{ asset("Icon/people.svg") }} @else {{ asset("Icon/people - 2.svg") }} @endif" alt="">
                    <a href="{{ route("users.index") }}" class="text-xl mr-5 text-[#686868] @if(Route::is("users.index") || Route::is("users.show")) text-primary @endif">کاربران</a>
                </li>
                <li class="flex mt-12 px-10">
                    <img class="w-7" src="@if(Route::is("articles.index") || Route::is("articles.create") || Route::is("articles.edit")) {{ asset("Icon/book-square.svg") }} @else {{ asset("Icon/book-square - 2.svg") }} @endif" alt="">
                    <a href="{{ route("articles.index") }}" class="text-xl mr-5 text-[#686868] @if(Route::is("articles.index") || Route::is("articles.create") || Route::is("articles.edit")) text-primary @endif">مقالات</a>
                </li>
                <li class="flex mt-12 px-10">
                    <img class="w-7" src="@if(Route::is("sliders.index") || Route::is("sliders.edit") || Route::is("sliders.create")) {{ asset("Icon/image.svg") }} @else {{ asset("Icon/image - 2.svg") }} @endif" alt="">
                    <a href="{{ route("sliders.index") }}" class="text-xl mr-5 text-[#686868] @if(Route::is("sliders.index") || Route::is("sliders.edit") || Route::is("sliders.create")) text-primary @endif">اسلایدر</a>
                </li>
                <li class="flex mt-12 px-10">
                    <img class="w-7" src="@if(Route::is("comment.index") || Route::is("comment.edit") || Route::is("comment.show")) {{ asset("Icon/image.svg") }} @else {{ asset("Icon/image - 2.svg") }} @endif" alt="">
                    <a href="{{ route("comment.index") }}" class="text-xl mr-5 text-[#686868] @if(Route::is("comment.index") || Route::is("comment.edit") || Route::is("comment.show")) text-primary @endif">کامنت ها</a>
                </li>
            </ul>
        </aside>
        <div class="lg:hidden menu duration-300 absolute right-[-260px] top-0 bottom-0 z-50 px-5 bg-[#f0f0f0]">
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
            <form action="{{ route("logout") }}" method="POST" class="flex items-center justify-center absolute bottom-10">
                @csrf
                <img src="{{ asset("Icon/logout_svgrepo.com.svg") }}" alt="Logout">
                <button type="submit" class="text-2xl font-bold text-primary mr-2">خروج از حساب</button>
            </form>
        </div>
        <div class="flex-1 body">
            <nav class="lg:hidden bg-white py-7 px-3 flex items-center justify-between gap-3 border-b-[1px] border-[#B2B2B2] border-opacity-30 shadow-md">
                <div class="flex gap-3 items-center">
                    <a href="#" class="header__link_menu">
                        <i class="fa-solid fa-bars fa-2xl"></i>
                    </a>
                    <h1 class="text-2xl">@yield('Title')</h1>
                </div>
                <a href="#" class="times max-sm:hidden">
                    <i class="fa-solid fa-times fa-2xl"></i>
                </a>

            </nav>
            <nav class="py-8 px-14 max-sm:hidden bg-white border-b-[1px] border-[#B2B2B2] border-opacity-30 w-full left-0 h-min flex items-center justify-between">
                <h1 class="text-3xl font-bold text-mblue">@yield('Title')</h1>
                <form action="{{ route("logout") }}" method="POST" class="flex items-center justify-center">
                    @csrf
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
<script>
    let menu = document.querySelector(".menu");
    let body = document.querySelector(".body");
    let times = document.querySelector(".times");
    let menuBtn = document.querySelector(".header__link_menu");
    let menubtnIcon = document.querySelector(".header__link_menu i");

    menuBtn.addEventListener("click", function () {
        if (menubtnIcon.classList.contains("fa-bars")) {
            menu.classList.remove('right-[-260px]')
            times.classList.remove("max-sm:hidden")
            menubtnIcon.classList = "fa fa-times fa-2xl"
        }else{
            menu.classList.add('right-[-260px]')
            times.classList.add("max-sm:hidden")
            menubtnIcon.classList="fa fa-bars fa-2xl"
        }
    })

    times.addEventListener("click", function () {
        menu.classList.add('right-[-260px]')
        times.classList.add("max-sm:hidden")
        menubtnIcon.classList="fa fa-bars fa-2xl"
    })
</script>
@yield('js')
</html>
