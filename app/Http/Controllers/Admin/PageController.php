<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Icon;
use App\Page;
use App\Categorie;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.page.liste', [
            'pages' => Page::all(),
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
        return view('admin.page.ajouter', [
            'icons' => Icon::all(),
            'categories' => Categorie::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (strlen($request->titre) > 255) {
            return back()->with('error', "Le titre de la page est trop long !");
        } else {
            $page = new Page;
            $page->icone = $request->icone;
            $page->titre = $request->titre;
            $page->contenu = $request->contenu;
            
            $page->save();
            return back()->with('success', "La page a été ajoutée avec succès !");
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
        if (count(Page::where('id', $id)->get()) == 0) {
            abort('404');
        }

        return view('admin.page.supprimer', [
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
        if (count(Page::where('id', $id)->get()) == 0) {
            abort('404');
        }
        return view('admin.page.details', [
            'icons' => Icon::all(),
            'pages' => Page::where('id', $id)->get(),
            'categories' => Categorie::all(),
            'id' => $id
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
        if (count(Page::where('id', $id)->get()) == 0) {
            abort('404');
        }

        if (strlen($request->titre) > 255) {
            return back()->with('error', "Le titre de la page est trop long !");
        } else {
            $page = Page::findOrFail($id);
            $page->icone = $request->icone;
            $page->titre = $request->titre;
            $page->contenu = $request->contenu;
            
            $page->save();
            return back()->with('success', "La page a été mise à jour avec succès !");
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
        if (count(Page::where('id', $id)->get()) == 0) {
            abort('404');
        }
        
        $page = Page::findOrFail($id);
        $page->delete();

        return redirect(route('listePage'))->with('success', "La page a été supprimée avec succès !");
    }
}
