@extends('layouts.testLayout')
@section('extra-style')
<link href="{{ asset('css/orderStyle.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="container row mt-5">
	<div class="col-md-4">
		{{-- <fieldset class="border p-2"> --}}
			<nav class="" style="text-align: center;">
				<ul>
					<li>
						<a href="#">Tableau de bord ></a>
					</li>
					<li class="active">
						<a href="{{ route('mes-commandes') }}">Mes Commandes ></a>
					</li>
					<li class="">
						<a href="#">Détails du compte ></a>
					</li>
					<li class="">
						<a href="#">Déconnexion ></a>
					</li>
				</ul>
			</nav>
		{{-- </fieldset> --}}
	</div>
	<div class="col-md-6"> 
		<!-- end sidebar -->
		<div class="my-profile">
			<div class="products-header">
				<h1 class="stylish-heading">Ma Commande N°{{ $id_commande }}</h1>
			</div>

			<div>
				<div>
					@foreach ($commande as $com)
					<div class="order-container border-2">
						<div class="flex border-2" style="background-color: #f4f5f7;">
							<div class="flex">
								<div>
									<div class="uppercase font-bold">Date commande</div>
									<div>{{ Carbon\Carbon::parse($com->created_at)->format('M d, Y') }}</div>
								</div>
								<div class="ml-3">
									<div class="uppercase font-bold">Id commande</div>
									<div>{{ ($com->id) }}</div>
								</div>
								<div class="ml-3">
									<div class="uppercase font-bold">Total</div>
									<div>{{ ($com->montant_commande) }} FCFA</div>
								</div>
							</div>
							<div>
								<div class="flex ml-10">
									<div><a href="#">Facture</a></div>
								</div>
							</div>
						</div>
						<div>
							@foreach ( unserialize($com->produits.$compteur) as $prod)
							<div class="flex">
								<img src="{{ asset('storage/'.$prod[$compteur]) }}" alt="Image produit" class="imgs ml-2">
								<ul>
									<li>Libelle: {{ ($prod[$compteur+1]) }}</li>
									<li>Prix: {{ ($prod[$compteur+2]) }}</li>
									<li>Quantité: {{ ($prod[$compteur+3]) }}</li>
								</ul><br>
							</div>
							@endforeach
						</div>
					</div>
					@endforeach
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
	</div>
</div>

@endsection