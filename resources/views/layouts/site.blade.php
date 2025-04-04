<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <x-head></x-head>
    <body class="font-sans antialiased">
        <div class="min-h-screen">
            @include('layouts.navbar')

            <!-- Page Content -->
            <main class="flex justify-center min-h-screen items-center">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
