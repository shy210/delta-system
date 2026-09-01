<!DOCTYPE html>
<html lang="es" class="h-full">

<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Delta System') }}</title>

    {{-- Tema --}}
    <script>
        (() => {
            const theme = localStorage.getItem('delta-theme');

            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();

        window.toggleDeltaTheme = function () {
            const html = document.documentElement;
            const isDark = html.classList.contains('dark');

            if (isDark) {
                html.classList.remove('dark');
                localStorage.setItem('delta-theme', 'light');
            } else {
                html.classList.add('dark');
                localStorage.setItem('delta-theme', 'dark');
            }
        };
    </script>

    {{-- Fuente --}}
    <link rel="preconnect" href="https://fonts.bunny.net">

    <link
        href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap"
        rel="stylesheet"
    />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-full bg-slate-50 font-sans text-slate-900 antialiased transition-colors duration-300 dark:bg-slate-950 dark:text-slate-100">

    {{-- Navegación --}}
    @include('layouts.navigation')

    {{-- Contenido --}}
    <div class="min-h-screen transition-colors duration-300 lg:pl-72">

        {{-- Page Heading --}}
        @isset($header)
            <header class="border-b border-slate-200 bg-white transition-colors duration-300 dark:border-slate-800 dark:bg-slate-900">
                <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        {{-- Page Content --}}
        <main class="min-h-screen transition-colors duration-300">
            {{ $slot }}
        </main>

    </div>

</body>

</html>