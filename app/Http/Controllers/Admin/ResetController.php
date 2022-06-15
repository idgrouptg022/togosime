<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class ResetController extends Controller
{
    public function password(Request $request) {

        $users = User::where('email', $request->email)->get();

        if (count($users) == 0) {
            return back()->with('error', "Adresse email non trouvée !");
        } else {

            /*foreach ($users as $user) {
                $id = $user->id;
            }

            $passowrd = rand(1201235210, 5412563985);

            $user_update = User::findOrFail($id);
            $user_update->password = sha1($passowrd);
            $user_update->save();

            $to_name = "Togosimé";
    
            $to_email = $request->email;
            $data = array("email" => $request->email, "motDePasse" => $password);
            \Mail::send('mails.user', $data, function($message) use ($to_name, $to_email) {
                $message->to($to_email)
                        ->subject('Réinitialisation de mot de passe');
            });*/

            return redirect(route('passwordSuccess'));
        }
    }

    public function passwordSuccess() {
        return view('admin.success.password');
    }

    public function updatePassword(Request $request) {
        
        if (count(User::where('id', session()->get('id'))->where('password', sha1($request->old_password))->get()) == 0) {
            return back()->with('error', "Ancien mot de passe incorrect !");
        } else {
            if ($request->password == $request->password_confirm) {
                $user = User::findOrFail(session()->get('id'));
                $user->password = sha1($request->password);
                $user->save();

                return back()->with('success', "Mot de passe mis à jour avec succès !");
            } else {
                return back()->with('error', "Les deux mot de passe ne sont pas identiques !");
            }
            
        }
        
    }
}
