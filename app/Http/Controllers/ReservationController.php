<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Model\Reservation;

use App\Http\Model\ReservationQuery;
use App\Http\Model\Reservationstockee;
use App\Http\Model\ReservationstockeeQuery;
use App\Http\Model\PileQuery;
use App\Http\Model\Pile;
use Illuminate\Support\Facades\DB;
use mysqli;
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
        
        $dateDebut = date_create($request->post("dateDebut"));
        $nbJours = intval($reservation->getNbjoursdestockageprevu());
        $dateD = $request->post("dateDebut");
        $dateFin = date_add($dateDebut, date_interval_create_from_date_string(" {$nbJours} days"));

        
        $dateFinStr = $dateFin->format("Y-m-d");   
  
        
        $pileVide = DB::select('call afficher_les_pile_vides(?,?)',array($request->post("dateDebut"),$dateFinStr));
        $pileVide = json_decode(json_encode($pileVide));
            
        $pileNonPleine = DB::select('call afficher_les_pile_non_pleine(?,?)',array($request->post("dateDebut"),$dateFinStr));
        $pileNonPleine = json_decode(json_encode($pileNonPleine));
        
   
        $lesReservationStcokee = array();    
        $quantite = $reservation->getQuantite();
        
        if(!empty($pileNonPleine)){

            
            foreach($pileNonPleine as $pile){
                
                $numPile = $pile->numPile;
                $numTravee = $pile->numTravee;
                $codeBloc = $pile->codeBloc;
                $capacite = $pile->capacite;
                
                $quantiteStockee = $pile->quantiteStokee;
                $emplacementDepart = $pile->emplacementDepart;
                
                
                $reservationstockee  = new Reservationstockee();               
                

                $reservationstockee->setPile(PileQuery::create()
                        ->filterByNumpile($numPile)
                        ->filterByNumtravee($numTravee)
                        ->filterByCodebloc($codeBloc)
                        ->findOneOrCreate());
                $reservationstockee->setReservation($reservation);
                $em = $emplacementDepart+$quantiteStockee +1;
                $reservationstockee->setEmplacementdepart($emplacementDepart + $quantite);
                $reservationstockee->setDatedebuteffective($request->post("dateDebut"));
                $reservationstockee->setDatefineffective($dateFinStr);
                
                $difference = $capacite - $quantiteStockee;
                
                if($difference > $quantite){
                    $reservationstockee->setQuantite($quantite);
                    $quantite = 0;
                    $reservationstockee->save();
                    
                    $lesReservationStcokee[] = $reservationstockee;
                   
                    break;
                }else {
                    $reservationstockee->setQuantite($difference);
                }
                
                $quantite = $quantite - $difference;
                $reservationstockee->save();
                $lesReservationStcokee[] = $reservationstockee;
                if($quantite <= 0){
                    
                    break;
                }
                
            }
        }
        
        
        if(!empty($pileVide) && $quantite > 0){
            
            foreach($pileVide as $pile){
             
                $numPile = $pile->numPile;
                $numTravee = $pile->numTravee;
                $codeBloc = $pile->codeBloc;
                $capacite = $pile->capacite;
                
                
                
                $reservationstockee  = new Reservationstockee();               
                

                $reservationstockee->setPile(PileQuery::create()
                        ->filterByNumpile($numPile)
                        ->filterByNumtravee($numTravee)
                        ->filterByCodebloc($codeBloc)
                        ->findOneOrCreate());
                $reservationstockee->setReservation($reservation);
                $reservationstockee->setEmplacementdepart(1);
                $reservationstockee->setDatedebuteffective($request->post("dateDebut"));
                $reservationstockee->setDatefineffective($dateFinStr);
                
                if($quantite >= $capacite){
                    $reservationstockee->setQuantite($capacite);                    
                }else {
                    $reservationstockee->setQuantite($quantite);
                }
                
                $quantite = $quantite - $capacite;
               
                $reservationstockee->save();
                $lesReservationStcokee[] = $reservationstockee;
                if($quantite <= 0){
                    
                    break;
                }
            }
        }
        $stored = false;
        if(!empty($lesReservationStcokee)){
            $stored = true;
        }

     
        return response()->json(array(
            'isStore' => $stored,

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
        $reservationStockee = ReservationstockeeQuery::create()->findByIdreservation($id);
        if ($reservation != null && $reservationStockee != null) {
            $reservationStockee->delete();
            $reservation->delete();
            $resultat = true;
        }
         return response()->json(array(
                    'isDeleted' => $resultat,                    
        ));
    }

    public function show($id, Request $request){
        
        $client = $request->session()->get('user');
        $reservation =  ReservationQuery::create()->findByArray(array(
            'Id' => $id,
            'numClient' => $client->getNumutilisateur()
        ));
        $resultat = $reservation->toJSON();
         
        return response($resultat);
    }

    
    
    function update(Request $request, $id)
    {
        $resultat = false;
        $reservation = ReservationQuery::create()->findPk($id);
        if($reservation != null)
        {
            $v = "encours";
            $reservation->setEtat($v);
            $reservation->save();
            $resultat = true;
        }
        
        return response()->json(array(
                    'isUpdated' => $resultat,                    
        ));
        
    }


    

}
