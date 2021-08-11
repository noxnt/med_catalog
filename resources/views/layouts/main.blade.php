<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Medicines</title>
</head>
<body>
    <div class="container">
        @if(Illuminate\Support\Facades\Route::currentRouteName() != 'index')
        <div class="row">
            <a class="nav-link pl-0 mt-1" href="{{ route('index') }}">To main page</a>
            <hr class="w-100 m-0">
        </div>
        @endif
        @yield('content')
    </div>
</body>
<script src="{{ asset('js/app.js') }}"></script>
</html>
