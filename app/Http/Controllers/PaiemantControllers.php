<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Produit;
use App\Models\Commande;
use DateTime;
use Illuminate\Support\Facades\Auth;

class PaiemantControllers extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Cart::count() <=0 )
        {
            messageflash("Désolé votre panier est vide.", "warning");
            return back();
        }

        $tax = config('cart.tax') / 100;
        $remise = request()->session()->get('coupon')['remise'] ?? 0;
        $newSubTotal =  (Cart::subtotal() - $remise);
        $newTax = $newSubTotal * $tax;
        $newTotal = ($newSubTotal + $newTax);
        if ($request->payment_method == 'Paypal') {
            return redirect()->route('make.payment');
        } else {
            return view('paiement.index')->with([
                'newTotal' => $newTotal,
            ]);
        }

    }

    public function indexInvite(Request $request)
    {
        if(Cart::count() <=0 )
        {
            messageflash("Désolé votre panier est vide.", "warning");
            return back();
        }

        $tax = config('cart.tax') / 100;
        $remise = request()->session()->get('coupon')['remise'] ?? 0;
        $newSubTotal =  (Cart::subtotal() - $remise);
        $newTax = $newSubTotal * $tax;
        $newTotal = ($newSubTotal + $newTax);
        if ($request->payment_method == 'Paypal') {
            return redirect()->route('make.payment');
        } else {
            return view('paiement.paiement_invite')->with([
                'newTotal' => $newTotal,
            ]);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Cart::count() <=0 )
        {
            messageflash("Désolé votre panier est vide.", "warning");
            return back();
        }

        if($this->checkIfNotAvailable()){
            messageflash("Un produit de votre panier n'est plus disponible en la quantité indoqué.", "error");
            return back();
        }
        $commande = new Commande();
        if(request()->session()->has('coupon')){
            $montantTotal = (Cart::subtotal() - request()->session()->get('coupon')['remise']) +
            ( (Cart::subtotal() - request()->session()->get('coupon')['remise']) *
                (config('cart.tax') / 100) );
        }else{
            $montantTotal = Cart::Total();
        }
        $produits = [];
        $i = 0;


        foreach (Cart::content() as $prod){
            $produits['produit_'.$i][] = $prod->model->image;
            $produits['produit_'.$i][] = $prod->model->libelle;
            $produits['produit_'.$i][] = $prod->model->prix;
            $produits['produit_'.$i][] = $prod->qty;
            $i++;
        }
        $commande->produits = serialize($produits);
        $commande->moyen_paiement = "orange money";
        $commande->montant_commande = $montantTotal;
        $commande->date_commande = (new DateTime())
        ->format('Y-m-d H-i-s');
        ;
        if (Auth::user()) {
            $commande->id_user = Auth::user()->id;
            // dd(!Auth::user()->id);
        }else{
            $commande->email_inviter = $request->email;
            // dd($request->email);
        }
        $commande->save();
        $this->updateStock();
        Cart::destroy();
        if (request()->session()->has('coupon')) {
            session()->forget('coupon');
            // dd('cool');
        }
        messageflash("Paiement effectué avec succé.", "success");
        return redirect()->route('prod');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function updateStock(){

        foreach (Cart::content() as $item){
            $produit = Produit::find($item->model->id);
            $produit->update(['qte_stock' => $produit->qte_stock - $item->qty]);
        }
    }
    private function checkIfNotAvailable(){

        foreach (Cart::content() as $item){
            $produit = Produit::find($item->model->id);

            if($produit->qte_stock < $item->qty){
                return true;
            }
        }
        return false;
    }
}
