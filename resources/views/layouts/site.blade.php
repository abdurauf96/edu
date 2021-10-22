<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">


    <style>
        .register-box{
            display: flex;

        }
        .register-box div{
            margin-right: 10px;
        }
        h1{
            font-size: 33px;
            margin-bottom: 20px;
        }
        .buttons{
            padding: 100px;
            display: flex;
        }
        a{
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 20px;
            margin-left: 20px;
            background-color: greenyellow;
            border-radius: 20px;
            padding: 10px 25px;
        }
    </style>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>


</head>
<body>
<div class="font-sans text-gray-900 antialiased">
    @yield('content')
</div>
</body>
</html>
