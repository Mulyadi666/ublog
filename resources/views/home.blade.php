<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    {{-- @vite(['resources/sass/app.scss']) --}}
</head>
<body class="bg-gray-50 dark:bg-gray-800">
    
    <x-navbar></x-navbar>
    <div class="container mx-auto px-36 py-14">
    <x-post></x-post>
    <x-list-post></x-list-post>
</div>
</body>
</html>