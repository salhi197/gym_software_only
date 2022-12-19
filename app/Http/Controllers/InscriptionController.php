<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Presence;
use App\Abonnement;
use App\Inscription;
use App\Membre;
use Auth;
use Carbon\Carbon;
use App\User;

class InscriptionController extends Controller
{


    public function destroy($id_inscription)
    {
        $inscription = Inscription::find($id_inscription);
        // dd($inscription);
        $inscription->delete();
        return redirect()->route('inscription.index')->with('success', ' Inséré avec succés ');          

    }
    public function index()
    {
        $abonnements = Abonnement::all();        
        $inscriptions = Inscription::all();        
        $coachs = User::where('grade',3)->get();
        $_abonnement = "";
        $_coach = "";
        return view('inscriptions.index',compact('inscriptions','abonnements','coachs',
            '_abonnement',
            '_coach'
        ));
    }

    public function filter(Request $request)
    {
        $users = User::where('isadmin',2)->get();        

        $result = Inscription::query();
        $result2 = Presence::query();
        $date_fin="";
        $date_debut="";
        $_user="";

        $_abonnement= $request['abonnement'];
        $_coach= $request['coach'];


        if (!empty($request['date_debut'])) {
            $date_debut=$request['date_debut'];    
            $result = $result->whereDate('created_at', '>=', $request['date_debut']);
            $result2 = $result2->whereDate('created_at', '>=', $request['date_debut']);
        }

        if (!empty($request['date_fin'])) {
            $date_fin=$request['date_fin'];    
            $result = $result->whereDate('created_at', '<=', $request['date_fin']);
            $result2 = $result2->whereDate('created_at', '<=', $request['date_debut']);   
        }

        if (!empty($request['coach'])) {
            
            $result = $result->where('coach', '=', $request['coach']);            
        } 


        if (!empty($request['abonnement'])) {
            
            $result = $result->where('abonnement', '=', $request['abonnement']);            
        } 
        $abonnements = Abonnement::all();        
        $coachs = User::where('grade',3)->get();


        $inscriptions = $result->get();

        $libres = $result2->get();
        $benefice = $result->get()->sum('total');
        $nombreInscriptions = count($inscriptions);
        $assurance = Membre::where('assurance',1)->get()->count();
        $assurance = $nombreInscriptions*1000;
        return view('inscriptions.index',compact('inscriptions',
            'date_debut',
            'abonnements',
            'coachs',
            'assurance',
            'libres',
            'date_fin',
            'benefice',
            '_user',
            'users',
            'nombreInscriptions',
            '_coach','_abonnement',
        ));

    }

    
    public function presence($inscription_id)
    {
        // $presences = Presence::where('inscription',$inscription_id)->get();
        $presences = Presence::where('inscription',$inscription_id)->get();
        $inscription = Inscription::find($inscription_id);
        $membre = Membre::find($inscription->membre);
        return view('inscriptions.presences',compact('presences','membre'));

    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'abonnement2'=>'required',
        ]);
        $membre = Membre::find($request->membre2);
        $inscription  = $membre->getLastInscription();
        $inscription->etat = 0;
        $inscription->save();


        $inscription = new Inscription();
        $inscription->debut=$request['debut2'];
        // $inscription->remarque=$request['remarque2'];
        $inscription->type=$request['type2'];
        //$inscription->activities=$request['activity2'];
        $fin =  Carbon::parse($request['debut2'])->addMonth($request['nbrmois2'])->format('Y-m-d');
        $inscription->fin=$fin;
        
        $inscription->nbsseance=$request['nbrmois2']*4*json_decode($request['abonnement2'])->nbrsemaine;
        $inscription->reste=$request['nbrmois2']*4*json_decode($request['abonnement2'])->nbrsemaine;
        
        $inscription->membre=$membre->id;
        $inscription->abonnement=json_decode($request['abonnement2'])->id;
        $inscription->etat=1;
        $inscription->total=$request['total2'];
        $inscription->remise=$request['remise2'];
        $inscription->nbrmois=$request['nbrmois2'];
        $inscription->versement=$request['versement2'];
    $inscription->user=Auth::user()->id;

        

        $inscription->save();
      
        
        return redirect()->route('membre.index')->with('success', ' inséré avec succés ');          
    }

    public function expirer()
    {
        $inscriptions = Inscription::where('reste','>',0)->whereDate('fin','>=',Carbon::today())->get();
        $abonnements = Abonnement::all();        

        return view('inscriptions.index',compact('inscriptions','abonnements'));
    }

}
