    @extends('layouts.testLayout')
    @section('content')
    
    @section('extra-style')
    <style>
    	.imgs {
    		border: 1px solid #ddd; /* Gray border */
    		border-radius: 4px;  /* Rounded border */
    		padding: 5px; /* Some padding */
    		width: 150px; /* Set a small width */
    	}

    	/* Add a hover effect (blue shadow) */
    	.imgs:hover {
    		box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
    	}
    </style>
    @endsection

    @section('extra-script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    @endsection
    @section('content')

    <div class="product-section container">
    	<div class="row">
            <div>
                <div class="product-section-image" style="height: 450px">
                    <img src="{{ asset('storage/'.$prod->image) }}" id="currentImg" class="active imgs" alt="Image produit" style="width: 100%; height: 100%;">
                </div>
                <div class="product-section-images mt-2">
                    @if ($prod->images)
                    <div class="product-section-thumbnail imgs" style="display: inline-block">
                        <img src="{{ asset('storage/'.$prod->image) }}"  class="newImg" style="height: 100px; width: 100%;" alt="Image produit">
                    </div>
                    @foreach (json_decode($prod->images, true) as $img)
                    <div class="product-section-thumbnail imgs" style="display: inline-block">
                        <img src="{{ asset('storage/'.$img) }}" alt="Image produit"  style="height: 100px; width: 100%;" class="newImg">
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
            <div class=" product-section-information ml-5 mt-3">
                <strong class="d-inline-block mb-2 text-primary product-section-title">{{ $prod->libelle }}</strong>
                <h3 class="mb-0 product-section-subtitle">{{ $prod->description }}</h3>
                <strong class="product-section-price">{{ $prod->prix }} FCFA</strong>
                <p>
                    <form action="{{ route('cart.store') }}" method="POST">
                        @csrf
                        <input type="hidden" value="{{ $prod->id }}" name=id>
                        <button type="submit" class="btn btn-dark">Ajouter au panier</button>
                    </form>
                </p>
            </div>
        </div>
    </div>


    @endsection

{{--     @section('extra-footer')
    <footer class="blog-footer">
    	<p>Blog template built for <a href="https://getbootstrap.com/">Bootstrap</a> by <a href="https://twitter.com/mdo">@mdo</a>.</p>
    	<p>
    		<a href="#">Back to top</a>
    	</p>
    </footer>
    @endsection --}}
    @section('extra-js')

    <script>
    	$('.newImg').on('click',  function() {
    		$('#currentImg').prop('src', this.src);
    	});
    </script>

    <script>
    	(function(){
    		const currentImage = document.querySelector('#currentImg');
    		const images = document.querySelectorAll('.product-section-thumbnail');
    		images.forEach((element) => element.addEventListener('click', thumbnailClick));
    		function thumbnailClick(e) {
    			currentImage.classList.remove('active');
    			currentImage.addEventListener('transitionend', () => {
    				currentImage.src = this.querySelector('img').src;
    				currentImage.classList.add('active');
    			})
    			images.forEach((element) => element.classList.remove('selected'));
    			this.classList.add('selected');
    		}
    	})();
    </script>

    @endsection