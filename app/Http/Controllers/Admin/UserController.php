<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Categorie;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function login(Request $request) {

        $users = User::where('email', $request->email)->where('password', sha1($request->password))->get();
        if (count($users) != 0) {
            foreach ($users as $user) {
                session()->put('id', $user->id);
            }
            return redirect(route('indexAdmin'));
        } else {
            return back()->with('error', "Email ou mot de passe non trouvé(s) !");
        }
        
    }

    public function profil() {
        return view('admin.profil', [
            'users' => User::where('id', session()->get('id'))->get(),
            'categories' => Categorie::all()
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.utilisateur.liste', [
            'users' => User::all(),
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
        
        if ($request->nom != "" && $request->email != "") {

            if (count(User::where('email', $request->email)->get()) == 0) {
                $password = rand(0123021450, 5412032548);
    
                $user = new User;
                $user->name = $request->nom;
                $user->email = $request->email;
                $user->password = sha1($password);
                $user->save();
    
                $to_name = "Deblaa";
    
                $to_email = $request->email;
                $data = array("email" => $request->email, "motDePasse" => $password);
                \Mail::send('mails.user', $data, function($message) use ($to_name, $to_email) {
                    $message->to($to_email)
                            ->subject('Compte utilisateur Togosimé');
                });
    
                return redirect(route('indexAdmin'))->with('success', "Compte créé avec succès !");
            } else {
                return back()->with('error', "Email dejà utilisé !");
            }

        } else {
            return redirect(route('indexAdmin'))->with('error', "Impossible de retourner un champs vide !");
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
        if (count(User::where('id', $id)->get()) == 0) {
            abort('404');
        }

        return view('admin.utilisateur.supprimer', [
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
        $user = User::findOrFail(session()->get('id'));
        $user->name = $request->nom;
        $user->email = $request->email;
        $user->save();

        return back()->with('success', "Compte mis à jour !");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (count(User::where('id', $id)->get()) == 0) {
            abort('404');
        }
        
        $user = User::findOrFail($id);
        $user->delete();

        return redirect(route('indexAdmin'))->with('success', "Utilisateur supprimé avec succès !");
    }

    public function logout() {
        session()->forget('id');

        return redirect(route('index'));
    }
}
