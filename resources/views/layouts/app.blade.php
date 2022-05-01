<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Bank</title>
    <link rel="icon" type="image/x-icon" href="{{asset('favicon.ico')}}">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/plugins.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/form-2.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/custom-loader.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/custom-modal.css')}}" rel="stylesheet" type="text/css">
    <link href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <script src="{{asset('js/jquery-3.1.1.min.js')}}"></script>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')
        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
</body>

</html>