<?php

namespace App\Http\Controllers\Visitors;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Categorie;
use App\Produit;
use App\Annonce;
use App\Page;
use App\Image;
use App\User;
use App\Team;
use App\Service;
use App\Site;

class MainController extends Controller
{
    public function listeProduitBanniere() {
        $produits = null;
        $produits = DB::table('banieres')
        ->join('produits', 'produits.id', '=', 'banieres.id_produit')->get();
        return $produits;
    }
    public function index() {
        $produit_bannieres = DB::table('banieres')
        ->join('produits', 'produits.id', '=', 'banieres.id_produit')->get();
        $nombreBanniere = 0;
        $nombreBanniere = DB::table('parametres')->where('nom', 'NOMBRE_BANNIERE')->first();

        return view('visitors.index', [
            'categories' => Categorie::all(),
            'produits' => Produit::orderByDesc('id')->paginate($nombreBanniere->valeur),
            'annonces' => Annonce::all(),
            'pages' => Page::all(),
            'images' => Image::all(),
            'i' => 0,
            'carousels' => $produit_bannieres,
            'members' => Team::all(),
        ]);
    }

    public function detailsPage($id) {
        return view('visitors.page.details', [
            'categories' => Categorie::all(),
            'pages' => Page::where('id', $id)->get()
        ]);
    }

    public function detailsAnnonce($id) {
        return view('visitors.annonce.details', [
            'categories' => Categorie::all(),
            'annonces' => Annonce::where('id', $id)->get()
        ]);
    }

    public function services() {
        return view('visitors.services', [
            'categories' => Categorie::all(),
            'services' => Service::all(),
        ]);
    }
    public function sitesTouristiques() {
        return view('visitors.sitesTouristiques', [
            'categories' => Categorie::all(),
            'sites' => Site::all(),
        ]);
    }
}
