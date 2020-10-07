<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use DB;

class ProductControllers extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $categorie = DB::table('categories')->get();
        // dd($categorie);
        if(request()->categorie){
            $prod = Produit::with('categories')
            ->whereHas('categories', function($query){
                $query->where('slug', request()->categorie);
                    })//->orWhere('qte_stock', '>', 0)
            ->orderBy('created_at', 'DESC')
            ->paginate(6);
            // dd($prod);
        }else{
            $prod = Produit::with('categories')
            ->Where('qte_stock', '>', 0)
            ->orderBy('created_at', 'DESC')
            ->paginate(6);
            //dd($prod);
        }
        //dd($prod);
        return view('produit.index' )->with('prod', $prod);
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
        //$prod = DB::table('produits')->whereId($id)->get();
        $prod = Produit::findOrFail($id);
        $st = $prod->qte_stock > 0 ? 'Disponible' : 'Indisponible';
        //dd($st);
        return view('produit.show')->with( [
            'prod' => $prod,
            'stock' => $st
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

    public function search()
    {
        request()->validate([
            'qr'=> 'required|min:3'
        ]);

        $qr = request()->input('qr');

        $prod = Produit::where('libelle', 'like', "%$qr%")
        ->orWhere('description', 'like', "%$qr%")
        ->paginate(6);
        // dd($prod);
        return view('Produit.search')->with([
            'SearchResult' => $prod
        ]);
    }
}
