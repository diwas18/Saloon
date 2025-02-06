<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
@include('layouts.alert')
     <div class="flex">
            <nav class="w-56 h-screen shadow-lg bg-gray-700">
                <img src="{{ asset('storage/images/logo.webp') }}" alt="Logo" class="w-32 mx-auto mt-4 filter brightness-0 invert">

                <ul class="mt-8">
                    <li class="mb-4">
                        <a href="{{route('dashboard')}}" class=" block hover:bg-orange-500 p-4 rounded-lg font-bold text-xl @if (Route::is('dashboard')) bg-blue-900 text-white hover:bg-blue-700 @endif"> Dashboard</a>

                    </li>
                    <li >
                    <a href="{{route('categories.index')}}" class=" block hover:bg-blue-200 p-4 rounded-lg font-bold text-xl"> Categories</a>

                </li>
                    <li >
                        <a href="{{route('services.index')}}" class=" block hover:bg-blue-200 p-4 rounded-lg font-bold text-xl"> Services</a>

                    </li>
                    <li >
                        <a href="{{route('works.index')}}" class=" block hover:bg-blue-200 p-4 rounded-lg font-bold text-xl"> Works</a>

                    </li>
                    <li >
                        <a href="{{route('experts.index')}}" class=" block hover:bg-blue-200 p-4 rounded-lg font-bold text-xl"> Team</a>

                    </li>
                    <li >
                        <a href="{{route('branches.index')}}" class=" block hover:bg-blue-200 p-4 rounded-lg font-bold text-xl"> Branches</a>
                        </li>
                        <li >
                            <a href="{{route('user.index')}}" class=" block hover:bg-blue-200 p-4 rounded-lg font-bold text-xl"> Users</a>
                            </li>

                    <li>
                        <form action="{{route('logout')}}" method="POST">
                            @csrf
                            <button type="submit" class="block hover:bg-blue-200 p-4 rounded-lg font-bold text-xl w-full text-left">Log Out

                            </button>

                        </form>
                    </li>

                </ul>
            </nav>
<div class="p-4 flex-1">
    @yield('content')
</div>

        </div>
    </body>
</html>


