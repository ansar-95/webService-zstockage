<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Model\Reservation;
use App\Http\Model\ReservationQuery;
class ReservationController extends Controller
{
    public function store(Request $request) {
       
        $client = $request->session()->get('user');
        $reservation = new Reservation();
        $reservation->setUtilisateur($client);
        $reservation->setEtat("demande");        
        $reservation->setDatereservation(date("Y-m-d H:i:s"));
        $reservation->setDateprevuestockage($request->post("dateDebut"));
        $reservation->setNbjoursdestockageprevu($request->post("nbJours"));
        $reservation->setQuantite($request->post("quantite"));
        $reservation->save();
        
        
        return response()->json(array(
            'isStore' => "true",
            'stored' => var_dump($reservation)
  
        ));
    }
    
    
    public function index(Request $request) {

        $client = $request->session()->get('user');
        $reservation = ReservationQuery::create()->findByArray(array(
            'numClient' => $client->getNumutilisateur()
        ));
        $resultat = $reservation->toJSON();
        
        return response($resultat);
    }
    
    public function destroy($id) {

        $resultat = false;
        $reservation = ReservationQuery::create()->findPk($id);
        if ($reservation != null) {
            $reservation->delete();
            $resultat = true;
        }
         return response()->json(array(
                    'isDeleted' => $resultat,                    
        ));
    }



    

}
