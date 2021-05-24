<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>TESTE</title>

        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <script src="{{asset('js/jquery.js')}}" charset="utf-8"></script>
        <script src="{{asset('js/sweetalert2.js')}}" charset="utf-8"></script>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    
    <body class="antialiased bg-light">
        @component('components/header')@endcomponent()

        @hasSection('js')
            @yield('js')
        @endif
        <div class="container-fluid">
            <div class="row mt-5">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            @hasSection('content')
                                @yield('content')
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>
