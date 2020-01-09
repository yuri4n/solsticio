<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
        <title>Admin</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
    </head>
    <body>
        <div id="app">
            <adminnavbar></adminnavbar>
            <admincenso></admincenso>
            <footer-component></footer-component>
        </div>

        <script src="{{asset('js/app.js')}}"></script>
    </body>
</html>
