<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Categorie;
use App\Produit;
use App\Image;
use App\Annonce;

class MainController extends Controller
{
    public function index() {

        if(!session()->has('id')) {
            abort('404');
        } else {
            return view('admin.index', [
                'categories' => Categorie::all(),
                'produits' => Produit::all(),
                'annonces' => Annonce::all(),
                'images' => Image::all()
            ]);
        }
    }
    public function login() {
        return view('admin.login');
    }

    public function messages() {
        return view('admin.message', [
            'categories' => Categorie::all(),
        ]);
    }

    public function baniere() {
        $nombreBanniere = 0;
        $nombreBanniere = \DB::table('parametres')->where('nom', 'NOMBRE_BANNIERE')->first();
        return view('admin.baniere.liste', [
            'categories' => Categorie::all(),
            "nombreBanniere" => $nombreBanniere
        ]);
    }
}
