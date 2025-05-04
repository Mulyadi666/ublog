<nav class="bg-white border-gray-200 dark:bg-gray-900 dark:border-gray-700">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">

    {{-- Logo selalu tampil --}}
    <a href="{{ route('home') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
      <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">ublog</span>
    </a>

    {{-- Hamburger --}}
    <button data-collapse-toggle="navbar-multi-level" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-multi-level" aria-expanded="false">
      <span class="sr-only">Open main menu</span>
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 17 14" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
      </svg>
    </button>

    <div class="hidden w-full md:block md:w-auto" id="navbar-multi-level">
      <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">

        {{-- Home & Contact selalu --}}
        <li>
          <a href="{{ route('home') }}"
             class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white">
            Home
          </a>
        </li>
        <li>
          <a href="#contact"
             class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white">
            Contact
          </a>
        </li>

        {{-- Jika bukan di halaman login/register --}}
        @unless(Route::is('login','register'))
          @guest
            {{-- Guest di halaman selain login/register --}}
            <li>
              <a href="{{ route('login') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent dark:text-white">
                Login
              </a>
            </li>
            <li>
              <a href="{{ route('register') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent dark:text-white">
                Sign Up
              </a>
            </li>
          @endguest

          @auth
            {{-- Authenticated user menu --}}
            <li class="relative">
              <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar" class="flex items-center py-2 px-3 text-gray-900 hover:bg-gray-100 dark:text-white">
                {{ Auth::user()->name }}
                <svg class="w-2.5 h-2.5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 10 6" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                </svg>
              </button>
              <div id="dropdownNavbar" class="hidden absolute right-0 mt-2 w-44 bg-white rounded-lg shadow divide-y divide-gray-100 dark:bg-gray-700">
                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200">
                  <li>
                    <form method="POST" action="{{ route('logout') }}">
                      @csrf
                      <button type="Arsip " class="w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200">
                        Arsip
                      </button>
                      <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200">
                        Logout
                      </button>
                    </form>
                  </li>
                </ul>
              </div>
            </li>
          @endauth
        @endunless

      </ul>
    </div>
  </div>
</nav>

{{-- Flowbite script untuk dropdown --}}
<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
