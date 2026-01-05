<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Admin - Verso' }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=poppins:400,500,600" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="flex min-h-screen">
            @include('sections.admin.sidebar')

            <div class="flex flex-1 flex-col min-w-0 overflow-hidden bg-brand-100">

                @include('sections.admin.topbar')

                <main class="flex-1 overflow-hidden p-5">
                    {{ $slot }}
                </main>

            </div>
        </div>
    </body>
</html>
