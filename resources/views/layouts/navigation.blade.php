<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
  <!-- Primary Navigation Menu -->
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16">
      <div class="flex">
        <!-- Logo -->
        <div class="shrink-0 flex items-center">
          <a href="{{ route('dashboard') }}">
            <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
          </a>
        </div>

        <!-- Navigation Links -->
        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
          <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __(' Dashboard ') }}
          </x-nav-link>
        </div>

        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
          <x-nav-link :href="route('employees.show',Auth::user()->id)" :active="request()->routeIs('employees.show')">
            {{ __('MyProfile') }}
          </x-nav-link>
        </div>

        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
          <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
            <x-slot name="slot">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" width="24" height="24" color="#000000">
                <defs>
                  <style>
                    .cls-6375f1aeb67f094e4896ca23-1 {
                      fill: none;
                      stroke: currentColor;
                      stroke-linecap: square;
                      stroke-miterlimit: 10;
                    }
                  </style>
                </defs>
                <g id="QR_Code" data-name="QR Code">
                  <rect class="cls-6375f1aeb67f094e4896ca23-1" x="1.5" y="1.5" width="8.59" height="8.59"></rect>
                  <polyline class="cls-6375f1aeb67f094e4896ca23-1" points="6.27 7.23 4.36 7.23 4.36 4.36 7.23 4.36"></polyline>
                  <polyline class="cls-6375f1aeb67f094e4896ca23-1" points="18.68 5.32 18.68 7.23 16.77 7.23"></polyline>
                  <polyline class="cls-6375f1aeb67f094e4896ca23-1" points="7.23 19.64 4.36 19.64 4.36 17.73"></polyline>
                  <polyline class="cls-6375f1aeb67f094e4896ca23-1" points="22.5 10.09 13.91 10.09 13.91 1.5 22.5 1.5 22.5 10.09"></polyline>
                  <rect class="cls-6375f1aeb67f094e4896ca23-1" x="13.91" y="13.91" width="8.59" height="8.59"></rect>
                  <rect class="cls-6375f1aeb67f094e4896ca23-1" x="1.5" y="13.91" width="8.59" height="8.59"></rect>
                  <rect class="cls-6375f1aeb67f094e4896ca23-1" x="16.77" y="16.77" width="1.91" height="1.91"></rect>
                </g>
              </svg>
            </x-slot>
          </x-nav-link>
        </div>

        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
          <x-nav-link :href="route('search.input')" :active="request()->routeIs('search.input')">
            {{ __('Search') }}
          </x-nav-link>
        </div>

        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
          <x-nav-link :href="route('tweet.timeline')" :active="request()->routeIs('tweet.timeline')">
            {{ __('Timeline') }}
          </x-nav-link>
        </div>

        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
          <x-nav-link :href="route('meeting.index')" :active="request()->routeIs('meeting.index')">
            {{ __('Event') }}
          </x-nav-link>
        </div>

        @can('register')
        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
          <x-nav-link :href="url('/admin/auth/login')" :active="request()->routeIs('admin.login')">
            管理画面
          </x-nav-link>
        </div>
        @endcan
      </div>

      <!-- Settings Dropdown -->
      <div class="hidden sm:flex sm:items-center sm:ms-6">
        <div class="mr-3">
          <img id="preview1" src="{{ isset(Auth::user()->profile_photo_path) ? asset('storage/' . Auth::user()->profile_photo_path) : asset('images/user_icon.png') }}" alt="" class="w-16 h-16 rounded-full object-cover border-none bg-gray-200" style="width: 45px; height: 45px;">
        </div>

        <x-dropdown align="right" width="48">
          <x-slot name="trigger">
            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
              <div>{{ Auth::user()->name }}</div>

              <div class="ml-1">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
              </div>
            </button>
          </x-slot>

          <x-slot name="content">
            <x-dropdown-link :href="route('profile.edit')">
              {{ __('Profile') }}
            </x-dropdown-link>

            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}">
              @csrf

              <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();

                                                this.closest('form').submit();">
                {{ __('Log Out') }}
              </x-dropdown-link>
            </form>
          </x-slot>
        </x-dropdown>
      </div>

      <!-- Hamburger -->
      <div class="-mr-2 flex items-center sm:hidden">
        <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
          <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
    </div>
  </div>

  <!-- Responsive Navigation Menu -->
  <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
    <div class="pt-2 pb-3 space-y-1">
      <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
        {{ __('Dashboard') }}
      </x-responsive-nav-link>
    </div>
    <!-- 🔽 一覧ページへのリンクを追加 -->
    <div class="pt-2 pb-3 space-y-1">
      <x-responsive-nav-link :href="route('employees.show',Auth::user()->id)" :active="request()->routeIs('employees.show')">
        {{ __('MyProfile') }}
      </x-responsive-nav-link>
    </div>
    <!-- 🔽 作成ページへのリンクを追加 -->
    <div class="pt-2 pb-3 space-y-1">
      <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
        <x-slot name="slot">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" width="24" height="24" color="#000000">
            <defs>
              <style>
                .cls-6375f1aeb67f094e4896ca23-1 {
                  fill: none;
                  stroke: currentColor;
                  stroke-linecap: square;
                  stroke-miterlimit: 10;
                }
              </style>
            </defs>
            <g id="QR_Code" data-name="QR Code">
              <rect class="cls-6375f1aeb67f094e4896ca23-1" x="1.5" y="1.5" width="8.59" height="8.59"></rect>
              <polyline class="cls-6375f1aeb67f094e4896ca23-1" points="6.27 7.23 4.36 7.23 4.36 4.36 7.23 4.36"></polyline>
              <polyline class="cls-6375f1aeb67f094e4896ca23-1" points="18.68 5.32 18.68 7.23 16.77 7.23"></polyline>
              <polyline class="cls-6375f1aeb67f094e4896ca23-1" points="7.23 19.64 4.36 19.64 4.36 17.73"></polyline>
              <polyline class="cls-6375f1aeb67f094e4896ca23-1" points="22.5 10.09 13.91 10.09 13.91 1.5 22.5 1.5 22.5 10.09"></polyline>
              <rect class="cls-6375f1aeb67f094e4896ca23-1" x="13.91" y="13.91" width="8.59" height="8.59"></rect>
              <rect class="cls-6375f1aeb67f094e4896ca23-1" x="1.5" y="13.91" width="8.59" height="8.59"></rect>
              <rect class="cls-6375f1aeb67f094e4896ca23-1" x="16.77" y="16.77" width="1.91" height="1.91"></rect>
            </g>
          </svg>
        </x-slot>
      </x-responsive-nav-link>
    </div>

    <div class="pt-2 pb-3 space-y-1">
      <x-responsive-nav-link :href="route('search.input')" :active="request()->routeIs('search.input')">
        {{ __('Search') }}
      </x-responsive-nav-link>
    </div>

    <div class="pt-2 pb-3 space-y-1">
      <x-responsive-nav-link :href="route('tweet.timeline')" :active="request()->routeIs('tweet.timeline')">
        {{ __('Timeline') }}
      </x-responsive-nav-link>
    </div>

    <div class="pt-2 pb-3 space-y-1">
      <x-responsive-nav-link :href="route('meeting.index')" :active="request()->routeIs('meeting.index')">
        {{ __('Event') }}
      </x-responsive-nav-link>
    </div>

    @can('register')
    <div class="pt-2 pb-3 space-y-1">
      <x-responsive-nav-link :href="url('/admin/auth/login')" :active="request()->routeIs('admin.login')">
        管理画面
      </x-responsive-nav-link>
    </div>
    @endcan
  </div>

  <!-- Responsive Settings Options -->
  <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
    <div class="px-4">
      <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
      <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
    </div>

    <div class="mt-3 space-y-1">
      <x-responsive-nav-link :href="route('profile.edit')">
        {{ __('Profile') }}
      </x-responsive-nav-link>

      <!-- Authentication -->
      <form method="POST" action="{{ route('logout') }}">
        @csrf

        <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();

                                        this.closest('form').submit();">
          {{ __('Log Out') }}
        </x-responsive-nav-link>
      </form>
    </div>
  </div>
  </div>
</nav>