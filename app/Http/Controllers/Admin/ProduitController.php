<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Produit;
use App\Categorie;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.produit.liste', [
            'produits' => Produit::all(),
            'categories' => Categorie::all()
        ]);
    }

    public function valeurNombreBanniere() {
        $nombreBanniere = 0;
        $nombreBanniere = \DB::table('parametres')->where('nom', 'NOMBRE_BANNIERE')->first();
        return response()->json($nombreBanniere);
    }
    public function modifierNombreBanniere(Request $request) {
        $nombreBanniere = \DB::table('parametres')->where('nom', 'NOMBRE_BANNIERE')->first();
        if(!is_object($nombreBanniere)) {
            \DB::table('parametres')->insert([
                ['nom' => 'NOMBRE_BANNIERE', 'valeur' => $request->valeur]
            ]);
        } else {
            \DB::table('parametres')->where('nom', 'NOMBRE_BANNIERE')->update(array('valeur' => $request->valeur));
        }
        return redirect('admin/banieres');
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
    public function ajouterProduitAuBanniere(Request $request) {
        $baniere = \DB::table('banieres')->where('id_produit', $request->id)->first();
        if(!is_object($baniere)) {
            \DB::table('banieres')->insert([
                ['id_produit' => $request->id]
            ]);
        }
        return redirect('admin/banieres');
    }
    public function supprimerProduitDuBanniere(Request $request) {
        $baniere = \DB::table('banieres')->where('id_produit', $request->id)->first();
        if(is_object($baniere)) {
            \DB::table('banieres')->where('id_produit', $request->id)->delete();
        }
        return redirect('admin/banieres');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->categorie == "") {
            return redirect(route('indexAdmin'))->with('error', "Vous devez sélectionner une catégorie !");
        }

        if (($_FILES['image']['name']!="")){
        
            $target_dir = "db/produits/";
            $file = $_FILES['image']['name'];
            $path = pathinfo($file);
            $filename = time();
            $ext = strtolower($path['extension']);

            if($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg') {
                $temp_name = $_FILES['image']['tmp_name'];
                $path_filename_ext = $target_dir.$filename.".".$ext;
                
                if (move_uploaded_file($temp_name,$path_filename_ext)) {

                    $produit = new Produit;
                    $produit->categorie_id = $request->categorie;
                    $produit->prix = $request->prix;
                    $produit->nom = $request->nom;
                    $produit->description = $request->description;
                    $produit->image = $path_filename_ext;
                    $produit->save();

                    return redirect(route('indexAdmin'))->with('success', 'Produit ajouté avec succèss !');
                } else {
                    return redirect(route('indexAdmin'))->with('error', 'Erreur de source iconnue. Réessayez !');
                }
            } else {
                return redirect(route('indexAdmin'))->with('error', 'Type de fichier non supporté !');
            }
        } else {
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (count(Produit::where('id', $id)->get()) == 0) {
            abort('404');
        }

        return view('admin.produit.supprimer', [
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
        if (count(Produit::where('id', $id)->get()) == 0) {
            abort("404");
        }
        return view('admin.produit.details', [
            'id' => $id,
            'produits' => Produit::where('id', $id)->get(),
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
        $produit = Produit::findOrFail($id);
        $produit->nom = $request->nom;
        $produit->categorie_id = $request->categorie;
        $produit->prix = $request->prix;
        $produit->description = $request->description;

        if (($_FILES['image']['name']!="")){
        
            $target_dir = "db/produits/";
            $file = $_FILES['image']['name'];
            $path = pathinfo($file);
            $filename = time();
            $ext = strtolower($path['extension']);

            if($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg') {
                $temp_name = $_FILES['image']['tmp_name'];
                $path_filename_ext = $target_dir.$filename.".".$ext;
                
                if (move_uploaded_file($temp_name,$path_filename_ext)) {

                    $produit->image = $path_filename_ext;
                    
                } else {
                    return redirect(route('indexAdmin'))->with('error', 'Erreur de source iconnue. Réessayez !');
                }
            } else {
                return redirect(route('indexAdmin'))->with('error', 'Type de fichier non supporté !');
            }
        }
        
        $produit->save();
        return redirect(route('detailsProduit', $id))->with('success', 'Produit à jour avec succèss !');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (count(Produit::where('id', $id)->get()) == 0) {
            abort('404');
        }
        
        $produit = Produit::findOrFail($id);
        $produit->delete();

        return redirect(route('listeProduit'))->with('success', "Le produit a été supprimé avec succès !");
    }
}
