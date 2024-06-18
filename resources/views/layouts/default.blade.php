<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
   <link rel="stylesheet" href="{{asset('css/dataTables.min.css')}}">
   <link rel="stylesheet" href="{{asset('css/dataTables.tailwindcss.css')}}">
   <link rel="stylesheet" href="{{asset('css/jquery-ui.min.css')}}">
   <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
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

    <script src="{{asset('js/jquery.quicksearch.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    @livewireScripts
    @yield('scripts')
</body>

</html>