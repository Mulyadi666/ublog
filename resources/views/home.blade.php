<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Home</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <script src="//unpkg.com/alpinejs" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-800">
    
    <x-navbar></x-navbar>
    <div x-data> 
    @auth
    <p class="text-green-500">User sudah login.</p>
    @endauth
    <div class="container mx-auto px-36 py-14 ">
        @include('components.post')
        <div x-data>
            <x-list-post :posts="$posts" />
            @include('components.edit-modal')
          </div>
</div>
</body>
</html>

  
</html>