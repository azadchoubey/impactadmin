<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    @livewireStyles
</head>

<body>

    <div id="main" class="row">

        @yield('content')
    </div>

    @livewireScripts
</body>

</html>