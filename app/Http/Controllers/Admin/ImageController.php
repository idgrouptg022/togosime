<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Image;
use App\Categorie;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.image.liste', [
            'images' => Image::all(),
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
        
            $target_dir = "db/images/";
            $file = $_FILES['image']['name'];
            $path = pathinfo($file);
            $filename = time();
            $ext = strtolower($path['extension']);

            if($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg') {
                $temp_name = $_FILES['image']['tmp_name'];
                $path_filename_ext = $target_dir.$filename.".".$ext;
                
                if (move_uploaded_file($temp_name,$path_filename_ext)) {
                    $image = new Image;
                    $image->fichier = $path_filename_ext;
                    $image->save();
                    return redirect(route('indexAdmin'))->with('success', 'Image ajoutée avec succèss !');
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
        if (count(Image::where('id', $id)->get()) == 0) {
            abort('404');
        }

        return view('admin.image.supprimer', [
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (count(Image::where('id', $id)->get()) == 0) {
            abort('404');
        }
        
        $image = Image::findOrFail($id);
        $image->delete();

        return redirect(route('indexAdmin'))->with('success', "Le contact a été supprimé avec succès !");
    }
}
