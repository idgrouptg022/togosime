<?php

namespace App\Http\Controllers\Visitors;
use App\Produit;
use App\Categorie;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductViewController extends Controller
{
    //
    public function produitCategorie($id){
        $produits = Produit::where('categorie_id', $id)->get();
        return view('visitors.produit.produitCategorie', [
            'produits' => $produits,
            'categories' => Categorie::all(),
        ]);
    }
    public function produitDetail($id) {
        $produit = Produit::find($id);
        if(is_object($produit)){
            return view('visitors.produit.produitDetail', [
                'produit' => $produit,
                'categories' => Categorie::all(),
            ]);
        }
        return redirect()->route('index');
    }
    public function produitRechercher(Request $request) {
        $produits = Produit::where('nom', 'LIKE', "%{$request->search}%")
        ->orWhere('description', 'LIKE', "%{$request->search}%")
        ->get();
        return view('visitors.produit.produitSearchResult', [
            'produits' => $produits,
            'categories' => Categorie::all(),
        ]);
    }
}
