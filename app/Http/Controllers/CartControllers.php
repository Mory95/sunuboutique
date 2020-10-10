<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use Gloudemans\Shoppingcart\Facades\Cart;
class CartControllers extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tax = config('cart.tax') / 100;
        $remise = request()->session()->get('coupon')['remise'] ?? 0;
        $newSubTotal =  (Cart::subtotal() - $remise);
        $newTax = $newSubTotal * $tax;
        $newTotal = ($newSubTotal + $newTax);
        return view('cart.index')->with([
            'newSubTotal' => $newSubTotal,
            'newTax' => $newTax,
            'newTotal' => $newTotal,
        ]);
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
        $dup = Cart::search(function ($cartitem, $rowId) use ($request){
            return $cartitem->id == $request->id;
        });

        if($dup->isNotEmpty()){
            messageflash("Produit déja ajouté.", "warning");
            return back();
        }
        $prod = Produit::findOrFail($request->id);

        Cart::add($prod->id, $prod->libelle, 1, $prod->prix)
        ->associate('App\Models\Produit');
        messageflash("Produit ajouté avec succé.", "success");
        return back();
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function AddProductToCart($id)
    {
        $dup = Cart::search(function ($cartitem, $rowId) use ($id){
            return $cartitem->id ==$id;
        });

        if($dup->isNotEmpty()){
            messageflash("Produit déja ajouté.", "warning");
            return back();
        }
        $prod = Produit::findOrFail($id);

        Cart::add($prod->id, $prod->libelle, 1, $prod->prix)
        ->associate('App\Models\Produit');
        messageflash("Produit ajouté avec succé.", "success");
        return back();
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
    public function update(Request $request, $rowId)
    {

        if($request['qte']>6){
            messageflash("La quatité ne peut pas dépasser 6.", "error");
            return back();
        }
        $qte_stock = Produit::findOrFail($request['id_prod']);
        //dd($qte_stock->qte_stock);
        if($qte_stock->qte_stock < $request['qte']){
            messageflash("Désolé ce produit n'a que ". $qte_stock->qte_stock . " exemplaire en stock.", "error");
            return back();
        }

        Cart::update($rowId, $request['qte']);
        messageflash("La quatité a bien été mise à jour.", "success");
        return back();
        // return $request->all();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($rowId)
    {
        Cart::remove($rowId);
        messageflash("Le Produit a bien été supprimé du panier","error");
        return back();    }
    }
