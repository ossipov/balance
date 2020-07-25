<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    @stack('meta')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>
<div id="app">
<section class="header flex items-center justify-between px-6 py-3">
    <a href="/" class="logo flex items-center px-3 py-1">
        <div class="bg-blue-500 rounded border-solid border-2 border-blue-500">
            <img src="/images/logo.svg" alt="YourBalance">
        </div>
        <div class="pl-3 font-semibold text-xl tracking-wide">
            Your<span class="text-blue-500">Balance</span>
        </div>
    </a>
    <div class="action-bar flex">
        <a href="#" class="notifications hover:bg-gray-100 rounded-full p-4 block mr-4" title="Notifications">
            <span>Notifications</span>
        </a>
        <a href="#" class="flex items-center">
            <img src="/images/avatar.png" alt="" class="w-8 mr-4">
            <span class=" tracking-wide font-bold text-gray-600 text-sm">Molly Green</span>
        </a>
    </div>
</section>

@yield('content')
</div>
<footer class="text-gray-600 text-center text-xs my-20">
    <a class="hover:underline" href="https://ossipov.me">ossipov.me</a>
</footer>
<script src="{{ mix('/js/app.js') }}"></script>
@stack('js')
</body>
</html>
