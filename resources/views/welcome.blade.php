<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body class="bg-gray-200">
        @if (Route::has('login'))
            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">ir al Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Login</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                    @endif
                @endauth
            </div>
        @endif
        <ul class="max-w-lg bg-white border-r border-gray-300 shadow-xl">
            @foreach ($repositories as $repository)
            <li class="flex items-center text-black p-2 hover:bg-gray-400">
                <img class="w-12 h-12 rounded-full mr-4" src="{{ $repository->user->profile_photo_url }}">
                <div class="flex justify-between w-full">
                    <div class="flex-1">
                        <h2 class="text-md font-semibold">{{ $repository->url }}</h2>
                        <p>{{ $repository->description }}</p>
                    </div>
                    <span class="text-xs text-gray-600">{{ $repository->created_at->diffForHumans() }}</span>
                </div>
            </li>
            @endforeach
        </ul>
    </body>
</html>
