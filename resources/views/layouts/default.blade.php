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
    <div id="processModal" class="fixed top-0 left-0 w-full h-full bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-8 rounded-lg shadow-lg">
        <p class="text-lg font-semibold mb-4">Processing...</p>
        <div class="flex justify-center">
            <!-- You can add loading animation or additional content here -->
            <svg class="animate-spin h-6 w-6 mr-3 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A8.001 8.001 0 0112 4.472v3.525l-2.84 2.839M20 12a8 8 0 01-8 8v4c6.627 0 12-5.373 12-12h-4z"></path>
            </svg>
            <span class="text-gray-700">Please wait...</span>
        </div>
    </div>
</div>


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