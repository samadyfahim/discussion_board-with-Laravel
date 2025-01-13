<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <style>
        body {
            font-family: Figtree, ui-sans-serif, system-ui, sans-serif;
            background-color: #f8fafc;
            color: #333;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            text-align: center;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn {
            display: inline-block;
            margin: 10px;
            padding: 10px 20px;
            font-size: 16px;
            text-decoration: none;
            border-radius: 4px;
            color: #fff;
            background-color: #6366f1;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #4f46e5;
        }

        .btn-secondary {
            background-color: #10b981;
        }

        .btn-secondary:hover {
            background-color: #059669;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Welcome to What Is Up?</h1>

        @if (Route::has('login'))
        <div>
            @auth
            <a href="{{ url('/dashboard') }}" class="btn">Dashboard</a>
            @else
            <a href="{{ route('login') }}" class="btn">Log in</a>
            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="btn btn-secondary">Register</a>
            @endif
            @endauth
        </div>
        @endif
    </div>
</body>

</html>