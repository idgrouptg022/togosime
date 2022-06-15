<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Categorie;
use App\Produit;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.categorie.liste', [
            'categories' => Categorie::orderByDesc('id')->get()
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
        $categorie = new Categorie;
        $categorie->nom = $request->nom;
        $categorie->save();

        return redirect(route('indexAdmin'))->with('success', "Catégorie ajoutée avec succès !");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (count(Categorie::where('id', $id)->get()) == 0) {
            abort('404');
        }

        return view('admin.categorie.supprimer', [
            'id' => $id,
            'categories' => Categorie::all()
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
        if (count(Categorie::where('id', $id)->get()) == 0) {
            abort("404");
        }
        return view('admin.categorie.details', [
            'id' => $id,
            'categoriesEdit' => Categorie::where('id', $id)->get(),
            'categories' => Categorie::all()
        ]);
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
        $categorie = Categorie::findOrFail($id);
        $categorie->nom = $request->nom;
        $categorie->save();

        return redirect(route('detailsCategorie', $id))->with('success', "Catégorie mise à jour avec succès !");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (count(Categorie::where('id', $id)->get()) == 0) {
            abort('404');
        }
        
        $categorie = Categorie::findOrFail($id);
        $categorie->delete();

        $produits = Produit::where('categorie_id', $id)->get();

        foreach ($produits as $produit) {
            $produit_del = Produit::findOrFail($produit->id);
            $produit_del->delete();
        }

        return redirect(route('listeCategorie'))->with('success', "La catégorie a été supprimée avec succès !");
    }
}
