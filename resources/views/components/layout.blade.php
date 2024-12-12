<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Blog</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    @if (config('app.env') == 'production')
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-P8QWX3DER5"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', 'G-P8QWX3DER5');
        </script>
    @endif
</head>

<body class="font-family-quicksand bg-slate-50 text-slate-600">
    <!-- navigation -->
    <nav class="flex justify-between shadow bg-slate-100 px-2">
        <ul>
            <li>
                <a class="font-bold text-blue-500 text-xl" href="{{ route('home') }}">Home</a>
            </li>
        </ul>
    </nav>

    <!-- content -->
    <div>
        {{ $slot }}
    </div>
</body>

</html>
