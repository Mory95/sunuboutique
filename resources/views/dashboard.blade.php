 <x-app-layout>
    <x-slot name="header">
        <h1 style="text-align: center;"><b>Bienvenue {{ Auth::user()->name }}</b></h1>
    </x-slot>
    <div class="container row mt-5">
        <div class="col-md-4">
            <fieldset class="border p-2">
                <nav class="">
                    <ul>
                        <li class="">
                            <a href="#">Tableau de bord ></a>
                        </li>
                        <li class="">
                            <a href="#">Commandes ></a>
                        </li>
                        <li class="">
                            <a href="#">Téléchargements ></a>
                        </li>
                        <li class="">
                            <a href="#">Adresses ></a>
                        </li>
                        <li class="ccount">
                            <a href="#">Détails du compte ></a>
                        </li>
                        <li class="">
                            <a href="#">Déconnexion ></a>
                        </li>
                    </ul>
                </nav>
            </fieldset>
        </div>
        <div class="col-md-6 ml-5 border-2">
            <p>
                Bonjour <strong>{{ Auth::user()->name }}</strong>
            </p>

            <p>
                À partir du tableau de bord de votre compte, vous pouvez visualiser vos 
                <a href="#">
                    commandes récentes
                </a>, gérer vos <a href="#">adresses de livraison et de facturation</a> ainsi que <a href="#">changer votre mot de passe et les détails de votre compte</a>.
            </p>
        </div>
    </div>


   {{--  <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-jet-welcome />

            </div>
        </div>
    </div> --}}
</x-app-layout>

{{-- @extends('layouts.dashboardLayout')
@section('content')
<div>
    <h1>cool</h1>
</div>
@endsection --}}