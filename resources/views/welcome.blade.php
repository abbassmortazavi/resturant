<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
        <title>Laravel</title>
        <link rel="stylesheet" href="/css/app.css">
        <script>
            (function(){
                window.Laravel = {
                    csrfToken: "{{ csrf_token() }}"
                }
            })();
        </script>
    </head>
    <body>
       <div id="app">
       @if(Auth::check())
            <main-app :user="{{ Auth::user() }}"></main-app>
            @else
            <main-app :user="false"></main-app>
       @endif

       </div>
       <script src="/js/app.js"></script>
    </body>
</html>
