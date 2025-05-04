{{-- resources/views/auth/login.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-50 dark:bg-gray-900">
  <x-navbar />

  <section class="flex items-center justify-center min-h-screen px-6">
    <div class="w-full max-w-md bg-white rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 p-6">
      <h1 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">
        Sign in to your account
      </h1>

      <form action="{{ route('login') }}" method="POST" class="space-y-4">
        @csrf

        {{-- Email --}}
        <div>
          <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            Your email
          </label>
          <input
            type="email"
            name="email"
            id="email"
            value="{{ old('email') }}"
            required
            autofocus
            class="w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
            placeholder="name@company.com"
          >
          @error('email')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
          @enderror
        </div>

        {{-- Password --}}
        <div>
          <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            Password
          </label>
          <input
            type="password"
            name="password"
            id="password"
            required
            class="w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
            placeholder="••••••••"
          >
          @error('password')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
          @enderror
        </div>

        {{-- Remember & Forgot --}}
        <div class="flex items-center justify-between">
          <label class="flex items-center text-sm text-gray-500 dark:text-gray-300">
            <input
              type="checkbox"
              name="remember"
              id="remember"
              class="w-4 h-4 mr-2 border rounded focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600"
            >
            Remember me
          </label>
          <a href="#" class="text-sm text-blue-600 hover:underline dark:text-blue-500">
            Forgot password?
          </a>
        </div>

        {{-- Submit --}}
        <button
          type="submit"
          class="w-full py-2.5 text-white bg-blue-600 rounded-lg text-sm font-medium hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600"
        >
          Sign in
        </button>

        {{-- Register Link --}}
        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
          Don’t have an account yet?
          <a href="{{ route('register') }}" class="font-medium text-blue-600 hover:underline dark:text-blue-500">
            Sign up
          </a>
        </p>
      </form>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>
</html>
