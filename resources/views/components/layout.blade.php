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
