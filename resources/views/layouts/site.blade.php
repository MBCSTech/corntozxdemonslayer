<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <x-head></x-head>
    <body class="font-sans antialiased">
        <div class="min-h-screen">
            @include('layouts.navbar')

            <!-- Page Content -->
            <main class="">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
