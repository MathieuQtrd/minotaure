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
        <nav class="bg-gray-800 p-4 text-white flex justify-between">
            <div class="max-w-4xl mx-auto flex space-x-4">
                <a href="{{ route('events.index') }}" class="text-lg hover:underline inline-block px-3">Accueil</a> 
                &nbsp;
                <a href="" class="text-lg hover:underline inline-block px-3">Contact</a>
                
            </div>
            <div class="space-x-4">
                @auth 
                    @if(auth()->user()->hasRole('admin'))
                        <a href="{{ route('dashboard') }}" class="text-lg hover:underline inline-block">Dashboard</a>
                        &nbsp;
                    @endif
                    <form action="{{ route('logout') }}" method="POST" class="inline-block">
                        @csrf 
                        <button type="submit" class="hover:underline">Déconnexion</button>
                    </form>
                @else 
                    <a href="{{ route('login') }}" class="text-lg  hover:underline px-3">Connexion</a>
                    <a href="{{ route('register') }}" class="text-lg hover:underline px-3">Inscription</a>
                @endauth
            </div>
        </nav>

        <main class="max-4xl mx-auto p-6">
            {{ $slot }}
        </main>
    </body>
</html>