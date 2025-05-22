<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/x-icon" href="/favicon.ico">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon-16x16.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/apple-touch-icon.png') }}">
        <!-- Script zum Verhindern von Flash of unstyled content -->
        <script>
            (function() {
                const isDark = localStorage.theme === 'dark' ||
                    (!('theme' in localStorage) &&
                    window.matchMedia('(prefers-color-scheme: dark)').matches);

                document.documentElement.classList.toggle('dark', isDark);

                const link = document.createElement('link');
                link.rel = 'manifest';
                link.href = `/manifest-${isDark ? 'dark' : 'light'}.webmanifest`;
                document.head.appendChild(link);
            })();
        </script>
        @vite('resources/css/app.css')
        @vite('resources/js/app.js')
        @inertiaHead
    </head>
    <body class="font-sans">
        @inertia
    </body>
</html>
