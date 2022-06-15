<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contact;
use App\Categorie;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.contact.liste', [
            'contacts' => Contact::all(),
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
        if(strlen($request->libelle) > 255 || strlen($request->libelle) > 255) {
            return back()->with('error', "Longeur de chaîne trop grande !");
        } else {

            $contact = new Contact;
            $contact->libelle = $request->libelle;
            $contact->valeur = $request->valeur;
            $contact->save();

            return back()->with('success', "Contact ajouté avec succès !");
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
        if (count(Contact::where('id', $id)->get()) == 0) {
            abort('404');
        }

        return view('admin.contact.supprimer', [
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
        if (count(Contact::where('id', $id)->get()) == 0) {
            abort("404");
        }
        return view('admin.contact.details', [
            'contacts' => Contact::where('id', $id)->get(),
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
        if (count(Contact::where('id', $id)->get()) == 0) {
            abort("404");
        }

        if(strlen($request->libelle) > 255 || strlen($request->libelle) > 255) {
            return back()->with('error', "Longeur de chaîne trop grande !");
        } else {

            $contact = Contact::findOrFail($id);
            $contact->libelle = $request->libelle;
            $contact->valeur = $request->valeur;
            $contact->save();

            return back()->with('success', "Contact mis à jour avec succès !");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (count(Contact::where('id', $id)->get()) == 0) {
            abort('404');
        }
        
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect(route('listeContact'))->with('success', "Le contact a été supprimé avec succès !");
    }
}
