@extends('layouts.login&register_layout')

@section('extra-style')
<link href="{{ asset('css/loginAndRegisterStyle.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container register mt-3 mb-2">
    <div class="row">
        <div class="col-md-3 register-left">
            <img src="https://image.ibb.co/n7oTvU/logo_white.png" alt="" class="ml-5">
            {{-- <h3>Cool</h3> --}}
            <p>Vous pouvez créer un compte en un temps record.</p>
            <form action="{{ route('register') }}" method="GET">
                <input type="submit" name="" value="Register"><br>
            </form>
            <p>Cliquez <a href="{{ route('payment.invite') }}"> ici </a>pour effectuer vos achat entant que invité.</p>
        </div>
        <div class="col-md-9 register-right">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <h3 class="register-heading">Formulaire de connexion</h3>
                    <div class="row register-form mt-5">
                        <div class="col-md-8 container">
                            <div class="form-group">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div>
                                        <x-jet-label value="{{ __('Email') }}" />
                                        <x-jet-input class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                                    </div>

                                    <div class="mt-4">
                                        <x-jet-label value="{{ __('Password') }}" />
                                        <x-jet-input class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                                    </div>

                                    <div class="block mt-4">
                                        <label class="flex items-center">
                                            <input type="checkbox" class="form-checkbox" name="remember">
                                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                        </label>
                                    </div>

                                    <div class="flex items-center justify-end mt-4">
                                        @if (Route::has('password.request'))
                                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                            {{ __('Forgot your password?') }}
                                        </a>
                                        @endif

                                        <x-jet-button class="ml-4">
                                            {{ __('Login') }}
                                        </x-jet-button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection






{{-- <x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label value="{{ __('Email') }}" />
                <x-jet-input class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label value="{{ __('Password') }}" />
                <x-jet-input class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <input type="checkbox" class="form-checkbox" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-jet-button class="ml-4">
                    {{ __('Login') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout> --}}
