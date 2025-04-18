<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <x-head></x-head>
    <style>
        .hide {
            overflow: hidden;
        }
    </style>
    <body class="font-sans antialiased">
        <div class="min-h-screen">
            @include('layouts.navbar')

            <!-- Page Content -->
            <main class="hide">
                {{ $slot }}
            </main>

            @if(!Request::is('game') && !Request::routeIs('game'))
                @include('layouts.footer')
            @endif
        </div>
    </body>
</html>
