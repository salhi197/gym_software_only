<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Membre;
use App\Inscription;
use App\Setting;
use App\Ouverture;
use App\Presence;

class ApiController extends Controller
{
    public function ouverture()
    {
        $ouverture = new Ouverture();
        try {
            $ouverture->save();
        } catch (\Throwable $th) {
            return response()->json(['reponse' => $th->getMessage()]);
        }
        return response()->json(['reponse' => 1]);    

    } 
    public function insertPresence(Request $request)
    {
        $setting = Setting::where('titre','activity')->first();
        $matricule= $request->matricule;
        $matricule = substr($matricule, 0, -2);
        $membre=Membre::where('matricule',$matricule)->first();
        if($membre){
            $inscription  = Inscription::where(['membre'=>$membre->id,'etat'=>1])->first();
            if($inscription){
                $presence = new Presence();
                $presence->inscription = $inscription->id;
                $presence->membre = $membre->id;
                // $presence->activity = $setting->value;
                //Membre::getActivity();
                try {
                    $presence->save();
                } catch (\Throwable $th) {
                    return response()->json(['reponse' => $th->getMessage()]);
                }
                $inscription->reste = $inscription->reste - 1;
                $inscription->save();
                return response()->json(['reponse' => 1]);    
            }    
        }
        return response()->json(['reponse' => $membre]);    


    } 
    public function verifier(Request $request)
    {
    
        $matricule= $request->matricule;
        $matricule = substr($matricule, 0, -2);

        $membre=Membre::where('matricule',$matricule)->first();
        if($membre){
            $reponse = $membre->isAuthorised();
            
            return response()->json(['reponse' => $reponse]);
        }else{
            return response()->json(['reponse' => -1]);
        }
    }
    public function createPresence(Request $request)
    {
        $matricule = $request->matricule;
        $presence = new Presnce();
        try {
            $presence->save();
        } catch (\Throwable $th) {
            return response()->json(['error' => 0]);
        }
        return response()->json(['error' => 1]);

    }
}
