<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- css -->
    <link rel="stylesheet" href="{{ config('app.subdir').mix('css/app.css') }}">

    @yield('styles')

    <title>@yield('title', 'LaraBBS') - 进阶</title>
    <meta name="description" content="@yield('description', 'LaraBBS 爱好者社区'    )">
</head>
<body>
    <div id="app" class="{{ route_class() }}-page">
    @include('layouts._header')
    <div class="container">
        @include('shared._messages')
        @yield('content')
    </div>
    @include('layouts._footer')
    </div>

    <!-- scripts -->
    <script src="{{ config('app.subdir').mix('js/app.js') }}"></script>

    @yield('scripts')
    
</body>
</html>