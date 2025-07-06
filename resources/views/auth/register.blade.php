<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>
  <x-navbar></x-navbar> {{-- Navbar --}}
  <section class="bg-gray-50 dark:bg-gray-900">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
      {{-- <a href="{{ url('/') }}" class="flex mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
        ublog
      </a> --}}
      <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
        <div class="p-6 space-y-4 sm:p-8">
          <h1 class="text-xl font-bold text-gray-900 md:text-2xl dark:text-white">
            Create an account
          </h1>

          {{-- ✨ Form Register --}}
          <form class="space-y-4 sm:space-y-6"  
                action="{{ route('register') }}"    {{-- arah ke route register --}}
                method="POST">                        {{-- gunakan POST --}}
            @csrf                                {{-- wajib CSRF token --}}

            {{-- Name --}}
            <div>
              <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
              <input type="text" name="name" id="name"
                     class="w-full p-2.5 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                     placeholder="Your name" required
                     value="{{ old('name') }}">
              @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
              @enderror
            </div>

            {{-- Email --}}
            <div>
              <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
              <input type="email" name="email" id="email"
                     class="w-full p-2.5 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                     placeholder="name@company.com" required
                     value="{{ old('email') }}">
              @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
              @enderror
            </div>

            {{-- Password --}}
            <div>
              <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
              <input type="password" name="password" id="password"
                     class="w-full p-2.5 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                     placeholder="••••••••" required>
              @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
              @enderror
            </div>

            {{-- Confirm Password --}}
            <div>
              <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm Password</label>
              <input type="password" name="password_confirmation" id="password_confirmation"
                     class="w-full p-2.5 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                     placeholder="••••••••" required>
            </div>

            {{-- Terms --}}
            <div class="flex items-start">
              <input id="terms" type="checkbox" name="terms"
                     class="w-4 h-4 border rounded focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600" required>
              <label for="terms" class="ml-2 text-sm text-gray-500 dark:text-gray-300">
                I accept the <a href="#" class="text-blue-600 hover:underline dark:text-blue-500">Terms and Conditions</a>
              </label>
            </div>

            {{-- Submit --}}
            <button type="submit"
                    class="w-full text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-500 dark:hover:bg-blue-600">
              Create an account
            </button>

            {{-- Link to Login --}}
            <p class="text-sm font-light text-gray-500 dark:text-gray-400">
              Already have an account?
              <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:underline dark:text-blue-500">
                Login here
              </a>
            </p>
          </form>

        </div>
      </div>
    </div>
  </section>
</body>
</html>
