<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
   <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.min.css">
   <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.tailwindcss.css">
    @livewireStyles
    @yield('style')
</head>

<body>
    <livewire:navbar />
    @yield('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="//cdn.datatables.net/2.0.2/js/dataTables.min.js" ></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.tailwindcss.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js" integrity="sha512-XMVd28F1oH/O71fzwBnV7HucLxVwtxf26XV8P4wPk26EDxuGZ91N8bsOttmnomcCD3CS5ZMRL50H0GgOHvegtg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables-buttons/3.0.1/js/dataTables.buttons.min.js" integrity="sha512-MRdyQUpDMsm89Lv64vwMZ9KNGiKdyfV1kSmors1lapx7Fac5Wj3s5njlojPhHukdVwbLD0lX78h+QG75z5Pyrg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @livewireScripts
    @yield('scripts')
</body>

</html>