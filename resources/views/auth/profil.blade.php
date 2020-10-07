@extends('layouts.testLayout')
@section('extra-style')
<link href="{{ asset('css/orderStyle.css') }}" rel="stylesheet">
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="container row mt-5">
	<div class="col-md-4">
		{{-- <fieldset class="border p-2"> --}}
			<nav class="" style="text-align: center;">
				<ul>
					<li class="">
						<a href="#">Tableau de bord ></a>
					</li>
					<li class="">
						<a href="{{ route('mes-commandes') }}">Mes Commandes ></a>
					</li>
					<li class="active">
						<a href="#">Détails du compte ></a>
					</li>
					<li class="">
						<a href="#">Déconnexion ></a>
					</li>
				</ul>
			</nav>
		{{-- </fieldset> --}}
	</div>
	<div class="col-md-6 ml-5"> 
		<!-- end sidebar -->
		<div class="my-profile">
			<div class="products-header">
				<h1 class="stylish-heading"><strong>Mon Profile</strong></h1>
			</div>

			<div>
				<div class="form-group">
					<form action="{{ route('mon-compte.update') }}" method="POST">
						@method('patch')
						@csrf
						<div>
							<input id="name" class="form-control" type="text" name="name" value="{{ old('name', Auth::user()->name) }}" placeholder="Name" required>
						</div>

						<div class="mt-4">
							<input id="email" class="form-control" type="email" name="email" value="{{ old('email', Auth::user()->email) }}" placeholder="Email" required>
						</div>
						{{-- Pour le mot de passe je veus un bouton(changer mot de passe) qui lors d'un click affiche les champs password et confirm password. --}}
						<div class="mt-4">
							<input class="form-control" id="password" type="password" name="password" placeholder="Password">
							<div class="mt-1">
								Laissez le champs(password) vide si vous voulez conserver l'ancien mot de passe
							</div>
						</div>

						<div class="mt-4">
							<input class="form-control" id="password-confirm" type="password" name="password_confirmation" placeholder="Confirm Password">
						</div>

						<div>
							<button type="submit" class="my-profile-button mt-3 btn btn-dark">
								Update Profile
							</button>
						</div>
					</form>
				</div>
		{{-- <p>
			Bonjour <strong>{{ Auth::user()->name }}</strong>
		</p>

		<p>
			À partir du tableau de bord de votre compte, vous pouvez visualiser vos 
			<a href="#">
				commandes récentes
			</a>, gérer vos <a href="#">adresses de livraison et de facturation</a> ainsi que <a href="#">changer votre mot de passe et les détails de votre compte</a>.
		</p> --}}
	</div>
</div>
@endsection  
@section('extra-js')

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


<script>
	@if(Session::has('message'))
	var type="{{Session::get('alert-type','info')}}"

	switch(type){
		case 'info':
		toastr.info("{{ Session::get('message') }}");
		break;
		case 'success':
		toastr.success("{{ Session::get('message') }}");
		break;
		case 'warning':
		toastr.warning("{{ Session::get('message') }}");
		break;
		case 'error':
		toastr.error("{{ Session::get('message') }}");
		break;
	}
	@endif
</script>
@endsection