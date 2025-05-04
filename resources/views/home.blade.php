<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <!-- Di dalam <head> layout utama -->
    {{-- <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>x --}}
    {{-- <script src="//unpkg.com/alpinejs" defer></script> --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body class="bg-gray-50 dark:bg-gray-800">
    
    <x-navbar></x-navbar>
  
    {{-- Alpine root --}}
    <div x-data>
      @auth
        <p class="text-green-500">User sudah login.</p>
      @endauth
  
      <div class="container mx-auto px-36 py-14">
        @include('components.post')
        <x-list-post :posts="$posts" />
      </div>
  
      {{-- Modal di luar container supaya menempel ke seluruh layar --}}
      @include('components.edit-modal')
    </div> {{-- <-- Tutup div x-data di sini --}}
  
  </body>

  
</html>