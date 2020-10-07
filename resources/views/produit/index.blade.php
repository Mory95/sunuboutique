    @extends('layouts.testLayout')
    @section('extra-style')
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    @endsection
    @section('content')
    <div class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">

            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="row mb-2">
                  @foreach ($prod as $p)
                  @if($p->qte_stock>0)
                  <div>
                    <div class="card shadow-sm" style="height: 460px; width: 350px; margin: 5px;">
                        <img src="{{ asset('storage/'.$p->image) }}" alt="Image produit" class="bd-placeholder-img card-img-top imgs" style="width: 100%; height: 250px;">
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

                                           <!--   <div class="card-footer px-1">
                                                <span class="float-right">
                                                <a data-toggle="tooltip" data-placement="top" title="Add to Cart">
                                                    <i class="fas fa-shopping-cart grey-text ml-3"></i>
                                                </a>
                                                <a data-toggle="tooltip" data-placement="top" title="Share">
                                                    <i class="fas fa-share-alt grey-text ml-3"></i>
                                                </a>
                                                <a class="active" data-toggle="tooltip" data-placement="top" title="Added to Wishlist">
                                                    <i class="fas fa-heart ml-3"></i>
                                                </a>
                                                </span>
                                            </div>  -->
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-content-center">

                    {{ $prod->appends( request()->input() )->links() }}

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
