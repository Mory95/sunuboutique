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
    {{-- ///////////////////////////////////// --}}

    <nav wire:id="nPccJiAnIYX8LrUUSFLh" x-data="{ open: false }" class="bg-white border-b border-gray-100">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo de notre entreprise -->

                    <!-- Navigation Links -->
                    <div class="{{-- hidden space-x-8 --}} sm:-my-px sm:ml-10 sm:flex">
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

                <!-- Settings Dropdown -->
                {{-- <div>
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                         <div class="relative" x-data="{ open: false }" @click.away="open = false" @close.stop="open = false">
                                <div @click="open = ! open">
                                    <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                                        <img class="h-8 w-8 rounded-full object-cover" src="https://ui-avatars.com/api/?name=admin&amp;color=7F9CF5&amp;background=EBF4FF" alt="admin">
                                                    </button>
                                </div>

                                <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute z-50 mt-2 w-48 rounded-md shadow-lg origin-top-right right-0" style="display: none;" @click="open = false">
                                    <div class="rounded-md shadow-xs py-1 bg-white">
                                        <!-- Parametre du compte -->
                                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                                        Parametre du compte
                                                    </div>

                                                     <a class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out" href="/user/profile">Profile</a>
                             

                                                    

                                                    <div class="border-t border-gray-100"></div>

                                                    <!-- Team Management -->
                                                    

                                                    <!-- Authentication -->
                                                    <form method="POST" action="http://127.0.0.1:8000/logout">
                                                        <input type="hidden" name="_token" value="QZSaqPiim5rZtgXQiRszT1Ip4NgXlDLaBJi2xplR">
                                                         <a class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out" href="http://127.0.0.1:8000/logout" onclick="event.preventDefault();
                                                                                        this.closest('form').submit();">Logout</a>
                             
                                                    </form>
                                    </div>
                                </div>
                            </div>

                    </div>

                    <!-- Hamburger -->
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    </div>
                </div> --}}
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
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- Dashboard --}}
            <nav class="nav d-flex justify-content-between">
                @foreach (DB::table('categories')->get() as $cat)
                <a class="p-2 text-muted" name="qr" href="#{{ route('produit.index', ['categorie' =>$cat->slug] ) }}">
                    {{ $cat->name }}
                </a>
                @endforeach
            </nav>
                            {{-- @if (request()->input('qr'))
                            <h4>{{ $produit->total() }} resultat pour la recherche "{{ request()->qr }}"</h4>
                            @endif --}}
                        </h2>
                    </div>

                    {{-- //////////////////////////////////    --}}
                    @yield('content')
                    @yield('extra-js')
                </body>
                </html>
