<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
   <link rel="stylesheet" href="{{asset('css/dataTables.min.css')}}">
   <link rel="stylesheet" href="{{asset('css/dataTables.tailwindcss.css')}}">
   @vite(['resources/css/app.css','resources/js/app.js'])
   @livewireStyles
</head>

<body>
    <livewire:navbar />


    @yield('content')
    {{ $slot }}


    
    <script src="{{asset('js/jquery.min.js')}}" ></script>
    <script src="{{asset('js/dataTables.min.js')}}" ></script>
    <script src="{{asset('js/dataTables.tailwindcss.js')}}"></script>
    <script src="{{asset('js/jszip.min.js')}}"></script>
    <script src="{{asset('js/dataTables.buttons.min.js')}}"></script>
    @livewireScripts
    @yield('scripts')
</body>


</html>