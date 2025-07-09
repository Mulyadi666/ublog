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
        <div 
            x-data="{
                lastScroll: 0,
                showNavbar: true,
                handleScroll() {
                    let current = window.pageYOffset
                    this.showNavbar = current < this.lastScroll || current <= 0
                    this.lastScroll = current
                }
            }"
            x-init="window.addEventListener('scroll', handleScroll)"
        >
            <div 
                x-show="showNavbar" 
                x-transition.duration.300ms
                style="position: sticky; top: 0; z-index: 50;"
            >
                <x-navbar></x-navbar>
            </div>
            <div class="container mx-auto px-36 py-14 ">
                @include('components.post')
                <div x-data>
                    <x-list-post :posts="$posts" />
                    @include('components.edit-modal')
                </div>
            </div>
        </div>
    </body>
</html>