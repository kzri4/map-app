<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width ,initial-scale=1.0">
    <title>{{ config('app.name', 'Sparta Shops') }} @yield('title')</title>
</head>
<body>
    @yield('content')
    @yield('script')
</body>
</html>