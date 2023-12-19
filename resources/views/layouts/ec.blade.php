<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
</head>
<body>
    <h1>@yield('title')</h1>
    <div class="content">
        @yield('content')
    </div>
    <footer>
        ©2023 laravel yoshida
    </footer>
</body>
</html>