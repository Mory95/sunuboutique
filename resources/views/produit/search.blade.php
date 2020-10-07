    @extends('layouts.testLayout')
    @section('content')
    <div class="antialiased">
    	<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">

    		<div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
    			<div class="row mb-2">
    				@foreach ($SearchResult as $p)
    				<div>
    					<div class="card shadow-sm" style="height: 460px; width: 350px; margin: 5px;">
    						<img src="{{ asset('storage/'.$p->image) }}" alt="Image produit" class="bd-placeholder-img card-img-top" style="width: 100%; height: 250px;">
    						<div class="card-body" >
    							@foreach ($p->categories as $item)
    							<strong class="d-inline-block mb-2">{{ $item->name }}</strong>
    							@endforeach
    							<br><strong class="d-inline-block mb-2 text-primary">{{ $p->libelle }}</strong>
    							<p class="card-text" id="libelle">{{ $p->description }}</p>
    							<strong class="stretched-link">{{ $p->prix }} FCFA</strong>
    							<div class="d-flex justify-content-between align-items-center">
    								<div class="btn-group">
    									<button type="button" class="btn btn-sm btn-outline-secondary">
    										<a href="{{ route('AddProductToCart', $p->id) }}" class="stretched-link text-dark" style="text-decoration: none;">
    											Ajouter au panier
    										</a>
    									</button>
    									<button type="button" class="ml-2 btn btn-sm btn btn-outline-dark">
    										<a href="{{ route('produit.show', $p->id) }}" class="stretched-link text-dark" style="text-decoration: none;">
    											Voire produit
    										</a>
    									</button>
    								</div>
    								<small class="text-muted">9 mins</small>
    							</div>
    						</div>
    					</div>
    				</div>
    				@endforeach
    			</div>
    		</div>
    	</div>
    </div>

    <div class="flex justify-content-center">

    	{{ $SearchResult->appends( request()->input() )->links() }}

    </div>
    @endsection
