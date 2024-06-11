<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
   <link rel="stylesheet" href="{{asset('css/dataTables.min.css')}}">
   <link rel="stylesheet" href="{{asset('css/dataTables.tailwindcss.css')}}">
   <link rel="stylesheet" href="{{asset('css/jquery-ui.min.css')}}">
   <link rel="stylesheet" type="text/css" href="{{asset('css/multi-select.css')}}">

    @vite(['resources/css/app.css','resources/js/app.js'])
    @livewireStyles
    @yield('style')
</head>

<body>
    <livewire:navbar />
    @yield('content')
 

    <script src="{{asset('js/jquery.min.js')}}" ></script>
    <script src="{{asset('js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('js/dataTables.min.js')}}" ></script>
    <script src="{{asset('js/dataTables.tailwindcss.js')}}"></script>
    <script src="{{asset('js/jszip.min.js')}}"></script>
    <script src="{{asset('js/dataTables.buttons.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>
    <script src="{{asset('js/jquery.multi-select.js')}}"></script>
    <script src="{{asset('js/tinymce.min.js')}}"></script>
    <script src="{{asset('js/icons.min.js')}}"></script>
    <script src="{{asset('js/jquery.quicksearch.min.js')}}"></script>

    @livewireScripts
    @yield('scripts')
</body>

</html>