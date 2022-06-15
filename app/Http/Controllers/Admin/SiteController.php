<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Site;
use Illuminate\Http\Request;
use App\Categorie;
use App\Annonce;
use Illuminate\Support\Facades\File;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categorie::all();
        $annonces = Annonce::all();
        $sites = Site::all();

        return view('admin.site.liste', compact('categories', 'annonces', 'sites'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categorie::all();
        $annonces = Annonce::all();

        return view('admin.site.ajouter', compact('categories', 'annonces'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string',
            'contenu' => 'required',
            'image' => 'required|file|image|mimes:jpg,png,jpeg'
        ],
        [
            'nom.required' => 'Veuillez renseigner le titre pour le site',
            'contenu.required' => 'La description de votre site est obligatoire, veuillez le renseigner',
            'image.required' => 'L\'image du site est requis',
            'image.file' => 'Veuillez sélectionner un fichier',
            'image.image' => 'Votre fichier selectionné n\'est pas une image',
            'image.mimes' => 'Votre image doit avoir l\'extension .png ou .jpg ou .jpeg'
        ]
    );

        if (request()->has('image')) {
            $site = Site::create([
                'image' => request()->image->storeAs("db/sites/", time(). "_" .$request->file('image')->getClientOriginalName(), 'public'),
                'nom' => $request->input('nom'),
                'description' => $request->input('contenu')
            ]);
        }

        return redirect(route('listeSite'))->with('success', 'Votre site a été ajouté avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function show(Site $site)
    {
        $categories = Categorie::all();
        $annonces = Annonce::all();

        return view('admin.site.show', compact('site', 'categories', 'annonces'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function edit(Site $site)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Site $site)
    {
        $request->validate([
            'nom' => 'required|string',
            'contenu' => 'required',
            'image' => 'file|image|mimes:jpg,png,jpeg'
        ],
        [
            'nom.required' => 'Veuillez renseigner le titre pour le site',
            'contenu.required' => 'La description de votre site est obligatoire, veuillez le renseigner',
            'image.file' => 'Veuillez sélectionner un fichier',
            'image.image' => 'Votre fichier selectionné n\'est pas une image',
            'image.mimes' => 'Votre image doit avoir l\'extension .png ou .jpg ou .jpeg'
        ]);

        $site->update([
            'nom' => $request->input('nom'),
            'description' => $request->input('contenu')
        ]);

        if (request()->has('image')) {
            $site->update([
                'image' => request()->image->storeAs("db/services/", time() . "_" . $request->file('image')->getClientOriginalName(), 'public'),
            ]);
        }

        return redirect()->back()->with('success', 'Le site a été modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function destroy(Site $site)
    {
        File::delete([
            public_path("storage/app/public/".$site->image)
        ]);

        $site->delete();

        return redirect()->back()->with('success', 'Le site a été supprimé avec succès');
    }
}
