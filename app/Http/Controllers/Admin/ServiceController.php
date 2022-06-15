<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Service;
use Illuminate\Http\Request;
use App\Categorie;
use App\Annonce;
use Illuminate\Support\Facades\File;

class ServiceController extends Controller
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
        $services = Service::all();

        return view('admin.service.liste', compact('categories', 'annonces', 'services'));
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

        return view('admin.service.ajouter', compact('categories', 'annonces'));
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
            'title' => 'required|string',
            'contenu' => 'required',
            'image' => 'required|file|image|mimes:jpg,png,jpeg'
        ],
        [
            'title.required' => 'Veuillez renseigner le titre pour le service',
            'contenu.required' => 'La description de votre service est obligatoire, veuillez le renseigner',
            'image.required' => 'L\'image du service est requis',
            'image.file' => 'Veuillez sélectionner un fichier',
            'image.image' => 'Votre fichier selectionné n\'est pas une image',
            'image.mimes' => 'Votre image doit avoir l\'extension .png ou .jpg ou .jpeg'
        ]);

        if (request()->has('image')) {
            
            Service::create([
                'image' => request()->image->storeAs("db/services/", time(). "_" .$request->file('image')->getClientOriginalName(), 'public'),
                'titre' => $request->input('title'),
                'contenu' => $request->input('contenu')
            ]);
        }

        return redirect(route('listeService'))->with('success', 'Votre service a été ajouté avec succès');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        $categories = Categorie::all();
        $annonces = Annonce::all();

        return view('admin.service.show', compact('service', 'categories', 'annonces'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'title' => 'required|string',
            'contenu' => 'required',
            'image' => 'file|image|mimes:jpg,png,jpeg'
        ],
        [
            'title.required' => 'Veuillez renseigner le titre pour le service',
            'contenu.required' => 'La description de votre service est obligatoire, veuillez le renseigner',
            'image.file' => 'Veuillez sélectionner un fichier',
            'image.image' => 'Votre fichier selectionné n\'est pas une image',
            'image.mimes' => 'Votre image doit avoir l\'extension .png ou .jpg ou .jpeg'
        ]);

        $service->update([
            'titre' => $request->input('title'),
            'contenu' => $request->input('contenu')
        ]);

        if (request()->has('image')) {
            $service->update([
                'image' => request()->image->storeAs("db/services/", time() . "_" . $request->file('image')->getClientOriginalName(), 'public'),
            ]);
        }

        return redirect()->back()->with('success', 'Le service a été modifié avec succès');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        File::delete([
            public_path("storage/app/public/".$service->image)
        ]);

        $service->delete();

        return redirect()->back()->with('success', 'Le service a été supprimé avec succès');
    }
}
