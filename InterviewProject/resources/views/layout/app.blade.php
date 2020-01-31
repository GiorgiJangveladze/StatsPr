<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->

     <link href="{{ asset('jqueryui/jquery-ui.min.css') }}" rel="stylesheet">
   
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{asset('alertifyjs/css/alertify.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <div class="container">
            <div class="m-subheader ">
                <div class="d-flex align-items-center">
                    @yield('content_header')
                </div>
            </div>
            <main class="py-4">
                    @yield('content')
            </main>
        </div>
    </div>

    @include('partials.scripts')
    @yield('scripts')
</body>
</html>
