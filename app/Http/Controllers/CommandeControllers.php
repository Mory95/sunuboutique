<?php

namespace App\Http\Controllers;
use App\Models\Commande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommandeControllers extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $commande = Commande::whereId_user( auth()->user()->id )->get();
        $i = 0;
        // var_dump(unserialize($commande->produits));
        return view('auth.mes-commandes')->with([
            'commandes'=> $commande,
            'compteur' => $i
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id_user=0;
        $i = 0;
        $commande = Commande::whereId($id)->get();
        foreach ($commande as $com) {
            $produit = [];
            $i = 0;
            foreach ( unserialize($com['produits']) as $prod ){
                $produit[$i][] = ($prod[$i]);
                $produit[$i][] = ($prod[$i+1]);
                $produit[$i][] = ($prod[$i+2]);
            }
            $id_user = $com['id_user'];
        }
        if(Auth::user()->id != $id_user){
            return back();
        }
        // for ($i=0; $i <6 ; $i++) { 
        //     var_dump($produit[0][$i]);
        // }
        return view('auth.ma-commande')->with([
            'commande' => $commande,
            'produits' => $produit,
            'compteur' => $i,
            'id_commande' => $id,
        ]);
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
}
