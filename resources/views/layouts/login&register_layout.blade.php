<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'MyEcommerce') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> --}}

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('extra-style')

    <!-- Script -->
    @yield('extra-script')
</head>


<body class="antialiased" style="background-color: #dedbd5">
    {{-- ///////////////////////////////////// --}}

    <nav wire:id="nPccJiAnIYX8LrUUSFLh" x-data="{ open: false }" class="bg-white border-b border-gray-100">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo de notre entreprise -->

                    <!-- Navigation Links -->
                    <div class="{{-- hidden space-x-8 --}} sm:-my-px sm:ml-10 sm:flex">
                        <a class="inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out" href="{{ route('prod') }}">
                            My-Ecommerce
                        </a>
                        @include('partials.search')
                    </div>
                </div>
                <ul class="inline-flex mt-3">
                    <li>
                        <a class="mr-2" href="{{ route('cart.index') }}" aria-label="Panier">
                            @if (Cart::Count() > 0 )
                            <strong>Panier<span class="badge badge-pill badge-dark">{{  Cart::Count() }}</span></strong>
                            @else
                            <strong>Panier</strong>
                            @endif

                        </a>
                    </li>
                    @if (Route::has('login'))
                    @auth
                    <button class="btn btn-outline-light text-dark  btn-sm" style=" height: 25px;">
                        <a href="{{ route('mon-compte') }}" class="" style=" text-decoration: none;">My Account</a>
                    </button>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                    @else
                    <li class="mr-2">
                        <a href="{{ route('login') }}" class="">Login</a>
                    </li>
                    @if (Route::has('register'))
                    <li class="">
                        <a href="{{ route('register') }}" class="">Register</a>
                    </li>
                    @endif
                    @endif
                    @endif
                    <li>
                    </li>

                </ul>
            </div>

            <!-- Responsive Navigation Menu -->
        </div>
    </nav>


    {{-- //////////////////////////////////    --}}
    @yield('content')
    @yield('extra-js')
</body>
</html>
