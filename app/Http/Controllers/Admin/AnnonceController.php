<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Annonce;
use App\Categorie;

class AnnonceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.annonce.liste', [
            'annonces' => Annonce::all(),
            'categories' => Categorie::all()
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

        if (($_FILES['image']['name']!="")){

            $target_dir = "db/annonces/";
            $file = $_FILES['image']['name'];
            $path = pathinfo($file);
            $filename = time();
            $ext = strtolower($path['extension']);

            if($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg') {
                $temp_name = $_FILES['image']['tmp_name'];
                $path_filename_ext = $target_dir.$filename.".".$ext;

                if (move_uploaded_file($temp_name,$path_filename_ext)) {

                    $annonce = new Annonce;
                    $annonce->titre = $request->titre;
                    $annonce->description = $request->description;
                    $annonce->image = $path_filename_ext;
                    $annonce->save();

                    return redirect(route('indexAdmin'))->with('success', 'Annonce ajoutée avec succèss !');
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
        if (count(Annonce::where('id', $id)->get()) == 0) {
            abort('404');
        }

        return view('admin.annonce.supprimer', [
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
        if (count(Annonce::where('id', $id)->get()) == 0) {
            abort("404");
        }
        return view('admin.annonce.details', [
            'id' => $id,
            'annonces' => Annonce::where('id', $id)->get(),
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

        $annonce = Annonce::findOrFail($id);
        $annonce->titre = $request->titre;
        $annonce->description = $request->description;

        if (($_FILES['image']['name']!="")){

            $target_dir = "db/annonces/";
            $file = $_FILES['image']['name'];
            $path = pathinfo($file);
            $filename = time();
            $ext = strtolower($path['extension']);

            if($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg') {
                $temp_name = $_FILES['image']['tmp_name'];
                $path_filename_ext = $target_dir.$filename.".".$ext;

                if (move_uploaded_file($temp_name,$path_filename_ext)) {

                    $annonce->image = $path_filename_ext;

                } else {
                    return redirect(route('indexAdmin'))->with('error', 'Erreur de source iconnue. Réessayez !');
                }
            } else {
                return redirect(route('indexAdmin'))->with('error', 'Type de fichier non supporté !');
            }
        }

        $annonce->save();
        return redirect(route('detailsAnnonce', $id))->with('success', 'Annonce mise à jour avec succèss !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (count(Annonce::where('id', $id)->get()) == 0) {
            abort('404');
        }

        $annonce = Annonce::findOrFail($id);
        $annonce->delete();

        return redirect(route('listeAnnonce'))->with('success', "L'annonce' a été supprimée avec succès !");
    }
}
