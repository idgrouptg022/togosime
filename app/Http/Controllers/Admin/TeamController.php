<?php

namespace App\Http\Controllers\Admin;

use App\Team;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Categorie;
use App\Annonce;
use Illuminate\Support\Facades\File;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Team::all();
        $categories = Categorie::all();
        $annonces = Annonce::all();
        return view('admin.equipe.liste', compact('members', 'categories', 'annonces'));
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
        return view('admin.equipe.ajouter', compact('categories', 'annonces'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        request()->validate([
            'image' => 'required|file|image|max:5000|mimes:jpg,jpeg,png'
        ],
            [
                'image.file' => 'Veuillez choisir un fichier',
                'image.required' => 'Ce champ est requis',
                'image.image' => 'Votre fichier n\'est pas une image',
                'image.max' => 'Votre image ne doit pas excéder 5Mo',
                'image.mimes' => 'Votre image doit être en format jpg, jpeg ou png'
            ]);

        if (request()->has('image')) {
            $image = Team::create([
                'photo' => request()->image->storeAs('db/equipes/', time() . "_" . $request->file('image')->getClientOriginalName(), 'public'),
                'nom' => $request->nom,
                'numero_telephone' => $request->telephone,
                'poste' => $request->poste,
                'details' => $request->contenu
            ]);
        }
        return redirect(route('listeMembre'))->with('success', "Le membre a été ajouté à l'équipe avec succès");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        $categories = Categorie::all();
        $annonces = Annonce::all();
        return view('admin.equipe.show', compact('team', 'categories', 'annonces'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        request()->validate([
            'image' => 'file|image|max:5000|mimes:jpg,jpeg,png',
            'nom' => 'required',
            'poste' => 'required',
            'telephone' => 'required'
        ],
            [
                'image.file' => 'Veuillez choisir un fichier',
                'image.image' => 'Votre fichier n\'est pas une image',
                'image.max' => 'Votre image ne doit pas excéder 5Mo',
                'image.mimes' => 'Votre image doit être en format jpg, jpeg ou png',
                'nom.required' => 'Le nom est requis',
                'poste.required' => 'Le poste est requis',
                'telephone.required' => 'Le numéro de téléphone est requis'
            ]
        );

        $team->update([
            'nom' => $request->input('nom'),
            'poste' => $request->input('poste'),
            'numero_telephone' => $request->input('telephone'),
            'details' => $request->input('contenu')
        ]);

        if ($request->has('image')) {
            $team->update([
                'photo' => $request->image->storeAs("db/equipes/", time() . "_" . $request->file('image')->getClientOriginalName(), 'public')
            ]);
        }

        return redirect()->back()->with('success', "Les infos du membre " . $team->nom . " ont été mises à jour avec succès");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        $nom = $team->nom;
        File::delete([
            public_path('storage/app/public/'.$team->photo)
        ]);

        $team->delete();
        return redirect()->back()->with('success', "Le membre ".$nom." a été supprimé de l'équipe avec succès");
    }
}
