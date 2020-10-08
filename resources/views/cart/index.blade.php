@extends('layouts.testLayout')
@section('extra-style')
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
@endsection
@section('content')

<div class="px-4 px-lg-0">

  <!-- End -->

  <div class="pb-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">

          <!-- Shopping cart table -->
          @if(Cart::count() > 0)
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col" class="border-0 bg-light">
                    <div class="p-2 px-3 text-uppercase">Produit</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase">Prix</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase">Quantité</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase">Retirer</div>
                  </th>
                </tr>
              </thead>
              <tbody>
                @foreach ( Cart::Content () as $prod)
                <tr>
                  <th scope="row">
                    <div class="p-2">
                      <div class="ml-3 d-inline-block align-middle">
                        <h5 class="mb-0"><a href="#" class="text-dark d-inline-block">{{ $prod->model->libelle }}</a></h5>
                        <img src="{{ asset('storage/'.$prod->model->image) }}" alt="" width="70" class="img-fluid rounded shadow-sm">
                        <span class="text-muted font-weight-normal font-italic">Category: Nom categorie</span>
                      </div>
                    </div>
                    <td class="align-middle"><strong>{{ $prod->Subtotal() }} FCFA</strong></td>
                    <td class="align-middle">
                      <strong>
                        <form action="{{ Route('cart.update', $prod->rowId)}}" method="POST">
                          @csrf
                          @method('PATCH')
                          <input type="hidden" value="{{ $prod->id }}" name="id_prod">
                          <select name="qte" id="qte" data-id="{{ $prod->rowId }}" class="custom-select" style="width: 50px">
                            @for ($i = 1; $i < 7; $i++)
                            <option value="{{ $i }}" {{ $i == $prod->qty ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                          </select>
                          <button type="submit" style="color: orange; border-style: none;">
                            <i class="fa fa-pencil-square fa-lg" aria-hidden="true" style="color: orange;">{{-- update --}}</i>
                          </button>
                        </form>
                      </strong>
                    </td>
                    <td class="align-middle">
                      <form action="{{ Route('cart.destroy', $prod->rowId)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">
                          <i class="fa fa-trash-o fa-lg" style="color: red ;">{{-- Delete --}}</i>
                        </button>
                      </form>
                    </td>
                  </th>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- End -->

          <div class="row py-5 p-4 bg-white rounded shadow-sm">
            <div class="col-lg-6">
              <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">CODE DE COUPON</div>
              @if (!request()->session()->has('coupon'))
              <div class="p-4">
                <p class="font-italic mb-4">Si vous avez un code promo, veuillez le saisir dans la case ci-dessous</p>
                <form action="{{ route('storeCoupon') }}" method="POST">
                  @csrf
                  <div class="input-group mb-4 border rounded-pill p-2">
                    <input type="text" placeholder="Appliquer coupon" name="code" aria-describedby="button-addon3" class="form-control border-0">
                    <div class="input-group-append border-0">
                      <button id="button-addon3" type="submit" class="btn btn-dark px-4 rounded-pill"><i class="fa fa-gift mr-2"></i>Appliquer coupon</button>
                    </div>
                  </div>
                </form>
              </div>
              @else
              <div class="p-4">
                <p class="font-italic mb-4">Un coupon est déja appliqué</p>
              </div>
              @endif
              <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">INSTRUCTIONS POUR LE VENDEUR</div>
              <div class="p-4">
                <p class="font-italic mb-4">Si vous avez des informations pour le vendeur, vous pouvez les laisser dans la case ci-dessous</p>
                <textarea name="" cols="30" rows="2" class="form-control"></textarea>
              </div>  
            </div>
            <div class="col-lg-6">
              <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">RÉCAPITULATIF DE LA COMMANDE </div>
              <div class="p-4">
                <p class="font-italic mb-4">Les frais d'expédition et les frais supplémentaires sont calculés en fonction des valeurs que vous avez saisies.</p>
                <ul class="list-unstyled mb-4">
                  <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">sous-total de la commande
                  </strong><strong>{{ Cart :: SubTotal () }}FCFA</strong></li>
                  @if (request()->session()->has('coupon'))
                  <li class="d-flex justify-content-between py-3 border-bottom">
                    <strong class="text-muted">Coupon: {{ request()->session()->get('coupon')['code'] ?? '' }}
                      <form action="{{ route('destroyCoupon') }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger">
                          <i class="fa fa-trash-o fa-lg" style="color: red; "></i>
                        </button>

                      </form>
                    </strong>
                    <strong>{{ request()->session()->get('coupon')['remise'] ?? 0 }} FCFA</strong>
                  </li>

                  <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Nouveau sous-total
                  </strong><strong>{{ $newSubTotal }}FCFA</strong></li>

                  <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Frais de port et de manutention
                  </strong><strong>{{ $newTax }}FCFA</strong></li>

                  <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Total</strong>
                    <h5 class="font-weight-bold">{{ $newTotal }}FCFA</h5>
                  </li>

                  @else
                  <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Frais de port et de manutention
                  </strong><strong>{{ Cart :: tax () }}FCFA</strong></li>

                  <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Total</strong>
                    <h5 class="font-weight-bold">{{ Cart::Total() }}FCFA</h5>
                  </li>
                  @endif

                </ul>
                <form action="{{ Route('paiemant.index')}}" method="GET">
                  @csrf
                  <a href="{{ route('make.payment') }}" class="btn btn-primary mt-3">Pay $224 via Paypal</a>
                  <label for="" class="form-check-label">
                    <input type="radio" class="form-check-input" name="payment_method" value="Paypal">Paypal
                  </label>
                  <label for="" class="form-check-label">
                    <input type="radio" name="payment_method" value="Autre">Autre
                  </label>
                  <button type="submit" class="btn btn-dark rounded-pill py-2 btn-block mt-3">
                    Passer à la caisse
                  </button>
                </form>
              </div>
            </div>
          </div>
          @else
          <div class="aler alert-warning text-center p-3">
            <h1>Votre panier est vide.</h1>
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
  @endsection()

  @section('extra-js')

  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

  {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
{{-- <script>
    (function(){
        const selects = document.querySelectorAll('#qte')

        Array.from(selects).forEach(function(element){
            element.addEventListener('change', function(){
                const rowId = this.getAttribute('data-id');
                alert('coollllllllll');
                axios.patch(`/panier/${rowId}`, {
                    qty : this.value
                })
            })
            .then(function(response){
                console.log(response);
            })
            .catch(function(error){
                console.log(error);
            })
        })
    })();
  </script> --}}

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
{{-- @section('extra-js')
  <script>
      var selects = document.querySelectorAll('#qte');
      Array.from(selects).forEach((element)=> {
        element.addEventListener('change' function(){
            var token = document.querySelector('meta[name = "csrf-token"]').getAttribute('content');
            var rowId = this.getAttribute('data-id');
            fetch(
                `/panier/${rowId}`,
                {
                    headers: {
                        "content-type": "application/json",
                        "Accept": "application/json, text-plain, */*",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN": token
                    },
                    method: 'patch',
                    body: JSON.stringify({
                        qty : this.value
                    })
                }
            ).then((data) => {
                console.log(data);
                location.reload();
            }).catch((error) => {
                console.log(error);
            })
        });
      });
  </script>
  @endsection --}}
