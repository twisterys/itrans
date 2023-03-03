<!doctype html>
<html lang="fr" dir="ltr">

    <head>
        <meta charset="utf-8" />
        <title> @yield('title') </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('images/favicon.ico')}}">
        @include('layouts.head')
  </head>
    @yield('body')

    @yield('content')

{{--    @include('layouts.footer-script')--}}
    </body>
</html>
