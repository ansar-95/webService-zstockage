<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Model\UtilisateurQuery;

class LoginController extends Controller
{
    public function authenticate(Request $request) {
        $resultat = false;
        $login = $request->post('login');
        $password = $request->post('password');

        $utilisateur = UtilisateurQuery::create()->findOneByArray(array(
            'login' => $login,
            'type' => 'client',));
        
        if ($utilisateur != null) {
   
                $request->session()->put('user', $utilisateur);                
                $resultat = true;
                
        }
        return response()->json(array(
            'connected' => $resultat
  
        ));
    }
    


}
