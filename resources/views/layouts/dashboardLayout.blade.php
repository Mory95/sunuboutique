<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>{{ config('app.name', 'MyEcommerce') }}</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

  {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> --}}

  <!-- Styles -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  @yield('extra-style')

  <!-- Script -->
  @yield('extra-script')
</head>


<body class="antialiased">
  <nav class="navbar navbar-expand-md navbar-dark"> 
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto" style="height: 300px;">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out" href="/dashboard">
            My-Ecommerce
          </a>
        </li>
        <li>
          <!-- Primary Navigation Menu -->
          <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
              <div class="flex">
                <!-- Logo de notre entreprise -->
                <div class="flex-shrink-0 flex items-center">
                  <a href="/dashboard">
                    <x-jet-application-mark class="block h-9 w-auto" />
                  </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                  <x-jet-nav-link href="/dashboard" :active="request()->routeIs('dashboard')">
                    {{ __('MyEcommerce') }}
                  </x-jet-nav-link>
                </div>
              </div>

              <!-- Settings Dropdown -->
              <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-jet-dropdown align="right" width="48">
                  <x-slot name="trigger">
                    <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                      <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    </button>
                  </x-slot>

                  <x-slot name="content">
                    <!-- Parametre du compte -->
                    <div class="block px-4 py-2 text-xs text-gray-400">
                      {{ __('Parametre du compte') }}
                    </div>

                    <x-jet-dropdown-link href="/user/profile">
                      {{ __('Profile') }}
                    </x-jet-dropdown-link>


                    <div class="border-t border-gray-100"></div>

                    <form method="POST" action="{{ route('logout') }}">
                      @csrf

                      <x-jet-dropdown-link href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                      this.closest('form').submit();">
                      {{ __('Logout') }}
                    </x-jet-dropdown-link>
                  </form>
                </x-slot>
              </x-jet-dropdown>
            </div>
          </div>
        </div>
      </li>
        {{-- <li class="nav-item">
          <form class="form-inline mt-2 mt-md-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
        </li> --}}
      </ul>
    </div>
  </nav>


  <nav wire:id="nPccJiAnIYX8LrUUSFLh" x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between h-16">
        <div class="flex">
          <!-- Logo de notre entreprise -->

          <!-- Navigation Links -->
          <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
            <a class="inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out" href="/dashboard">
              My-Ecommerce
            </a>
            <form class="navbar-form navbar-left ml-3 mt-3" action="/action_page.php">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Search">
                <div class="input-group-btn">
                  <button class="btn btn-primary" type="submit">
                    <span class="glyphicon glyphicon-search"></span>Search
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>

        <b class="mt-3 mr-20">
          <a class="nav-link panier" href="{{ route('cart.index') }}" aria-label="Panier">
                    {{-- @if (Cart::instance('defeault')->count() >= 0 )
                        <span class="badge badge-pill badge-dark">{{  Cart::Count() }}</span>
                        @endif --}}
                        <span>Panier</span>
                        <span class="badge badge-pill badge-dark">{{  Cart::Count() }}</span>
                      </a>
                    </b>
                  </div>

                  <!-- Responsive Navigation Menu -->
                </div>
              </nav>
              @yield('content')
              @yield('extra-js')
            </body>
            </html>
