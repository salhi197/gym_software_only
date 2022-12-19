<?php



namespace App\Http\Controllers;

use App\Presence;
use App\Membre;
use App\Abonnement;
use App\Assurance;
use App\Decharge;
use App\Inscription;
use App\Ouverture;
use DB;
use Carbon\Carbon;
use Storage;
use App\Setting;
use App\User;
use Illuminate\Http\Request;
use Response;

class HomeController extends Controller
{

    public function index()
    {
        $presences = Presence::whereDate('created_at', Carbon::today())->get();
        $inscrit = Inscription::where('created_at', Carbon::today())->get();
        $inscrit = count($inscrit);
        $count_presences = count($presences);
        $inscriptions = Inscription::whereDate('created_at', Carbon::today())->get();

        $membres = Membre::whereDate('created_at', Carbon::today())->get();
        $ouvertures = Ouverture::whereDate('created_at', Carbon::today())->get()->count();
        $libres = Presence::where('type',1)->whereDate('created_at', Carbon::today())->where('membre',null)->get();
              
        return view('home',compact('presences','membres','inscrit','presences','count_presences','inscriptions','ouvertures','libres'));    
    }

    /**
     * RAPPORT LIBRES
     */
    public function libres()
    {
        $benefice = Presence::where('type',1)->sum('prix');
        $libres = Presence::where('type',1)->get();
        $presences = Presence::all();
        return view('libres',compact('benefice','libres','presences'));
    }

    public function libresFilter(Request $request)
    {
        $date_debut= "";
        $date_fin= "";        
        $result = Presence::query();
        if (!empty($request['date_debut'])) {
            $date_debut=$request['date_debut'];    
            $result = $result->whereDate('created_at', '>=', $request['date_debut']);
        }
        if (!empty($request['date_fin'])) {
            $date_fin=$request['date_fin'];    
            $result = $result->whereDate('created_at', '<=', $request['date_fin']);
        }

        $benefice = $result->get()->where('type',1)->sum('prix');
        $libres = $result->get()->where('type',1);

        // $presences = Presence::all();
        return view('libres',compact('benefice','libres','date_debut','date_fin'));
    }


    /**
     * RAPPORT ASSURACES
     */
    public function assurances()
    {
        $assurances = Assurance::all();
        $assurancesSolde = Assurance::sum('prix');
        return view('assurances',compact(
            'assurances',
            'assurancesSolde'
        ));
    }

    public function assurancesFilter(Request $request)
    {
        $date_debut= "";
        $date_fin= "";        
        $result = Assurance::query();
        if (!empty($request['date_debut'])) {
            $date_debut=$request['date_debut'];    
            $result = $result->whereDate('created_at', '>=', $request['date_debut']);
        }
        if (!empty($request['date_fin'])) {
            $date_fin=$request['date_fin'];    
            $result = $result->whereDate('created_at', '<=', $request['date_fin']);
        }

        $assurancesSolde = $result->get()->sum('prix');
        $assurances = $result->get();

        return view('assurances',compact(
            'assurancesSolde',
            'assurances',
            'date_debut',
            'date_fin'          
        ));
    }


    public function activities()
    {
        $benefice = Presence::where('type',1)->sum('prix');
        $libres = Presence::where('type',1)->get();
        $presences = Presence::all();
        
        return view('activities',compact('benefice','libres','presences'));
    }




    public function FilterActivities(Request $request)
    {

        $result = Presence::query();
        $date_fin="";
        $date_debut="";
        if (!empty($request['date_debut'])) {
            $date_debut=$request['date_debut'];    
            $result = $result->whereDate('created_at', '=', $request['date_debut']);
        }

        if (!empty($request['date_fin'])) {
            $date_fin=$request['date_fin'];    
            $result = $result->whereDate('created_at', '<=', $request['date_fin']);
        }


        if (!empty($request['a'])) {
            $a=$request['a'];    
            $result = $result->where('activity', '=', $a);
        }
        $presences = $result->get();
        
        return view('activities',compact('benefice','libres','presences','date_debut'));
    }

    public function stats()
    {
        $presences = Presence::whereDate('created_at', Carbon::today())->get();

        $inscriptions = Inscription::all();//('created_at', Carbon::today())->get();
        $countInscriptions = count($inscriptions);

        $countDecharges = count(Decharge::all());
        $decharges = Decharge::all()->pluck('montant')->sum();

        $count_presences = count($presences);
        $inscriptions = Inscription::where('created_at', Carbon::today())->get();
        $membres = Membre::whereDate('created_at', Carbon::today())->get();
        $ouvertures = Ouverture::whereDate('created_at', Carbon::today())->get()->count();

        $libres = Presence::where('membre',null)->get();
        $beneficeLibres = Presence::where('membre',null)->sum('prix');
        $users = User::where('isadmin',2)->get();
        $_user = '';//User::where('isadmin',2)->get();
            



        $benefice = Inscription::all()->sum('total');
        
        $assurances = Assurance::get()->count();
        $assurancesSolde = Assurance::sum('prix');



        return view('stats',compact(
            'assurances',
            '_user',
            'assurancesSolde',
            'beneficeLibres',
            'presences',
            'membres',
            'countDecharges',
            'users',
            'presences',
            'count_presences',
            'inscriptions',
            'ouvertures',
            'libres',
            'countInscriptions',
            'benefice',
            'decharges'
        ));    

    }

    public function statsFilter(Request $request)
    {
        
        $result = Inscription::query();
        $result2 = Presence::query();
        $result3 = Membre::query();
        $result4 = Assurance::query();
        $result5 = Decharge::query();

        $date_fin="";
        $date_debut="";

        if (!empty($request['date_debut'])) {
            $date_debut=$request['date_debut'];    
            $result = $result->whereDate('created_at', '>=', $request['date_debut']);
            $result2 = $result2->whereDate('created_at', '>=', $request['date_debut'])->where('membre',null);
            $result4 = $result4->whereDate('created_at', '>=', $request['date_debut']);
            $result5 = $result5->whereDate('date_decharge', '>=', $request['date_debut']);
            $result3 = $result3->whereDate('created_at', '>=', $request['date_debut']);//->where('assurance',1);
        }

        if (!empty($request['date_fin'])) {
            $date_fin=$request['date_fin'];    
            $result = $result->whereDate('created_at', '<=', $request['date_fin']);
            $result4 = $result4->whereDate('created_at', '<=', $request['date_fin']);
            $result5 = $result5->whereDate('date_decharge', '<=', $request['date_fin']);
            $result2 = $result2->whereDate('created_at', '<=', $request['date_fin'])->where('membre',null);
            $result3 = $result3->whereDate('created_at', '<=', $request['date_fin']);//->where('assurance',1);
  
        }


        if (!empty($request['user'])) {
            $date_fin=$request['date_fin'];    
            $result = $result->where('user', '=', $request['user']);
            $result4 = $result4->where('user', '=', $request['user']);
            // $result3 = $result3->where('user', '=', $request['user']);//->where('assurance',1);
            $result2 = $result2->where('user', '=', $request['user'])->where('membre',null);
            $result5 = $result5->where('user', '=', $request['user']);


  
        }

        $inscriptions = $result->get();
        $countInscriptions = count($inscriptions);
        $libres = $result2->get();
        $assurance = count($result3->get());

        $totalAssurance = $assurance*1000;

        $libres = $result2->get();//Presence::where('type',1)->get();
        $beneficeLibres = $result2->get()->sum('prix');
        $countLibre = count($libres);

        $benefice = $result->get()->sum('versement');
        $nombreInscriptions = count($inscriptions);
        $assurancesSolde = $result4->get()->sum('prix');
        $assurances = count($result4->get());

        $countDecharges = count($result5->get());
        $decharges      = $result5->get()->sum('montant');


        $users = User::where('isadmin',2)->get();
        $_user = $request['user'];//User::where('isadmin',2)->get();
        return view('stats',compact('inscriptions',
            'date_debut',
            'assurances',
            '_user',
            'users',
            'libres',
            'assurancesSolde',
            'date_fin',
            'beneficeLibres',
            'countDecharges',
            'decharges',
            'assurance',
            'countLibre',
            'totalAssurance',
            'benefice',
            'countInscriptions'
        ));

    }
    public function clear()
    {
        Storage::put('records.txt', '');
        return redirect()->route("setting.index")->with('success', 'success');                

    }



    public function format()
    {
        Membre::truncate();
        Inscription::truncate();
        Ouverture::truncate();
        Presence::truncate();
        Decharge::truncate();
        Setting::truncate();
        return redirect()->route("home")->with('success', 'success');                

    }



    public function write(Request $request)
    {
        if($request->ajax()){
            Storage::put('logs.txt', '0');
            return response()->json(['error' => 0]);
        }
        
    }



    public function write2(Request $request)
    {
        if($request->ajax()){
            Storage::put('logs2.txt', '0');
            return response()->json(['error' => 0]);
        }
        
    }

    public function activity(Request $request)
    {
        $setting = Setting::where('titre','activity')->first();
        $setting->value = $request['dz'];
        $setting->save();
        return redirect()->back()->with('success', 'success');                
    }

    public function rapport()
    {
        $abonnements = Abonnement::all();        
        $users = User::where('isadmin',2)->get();        
        $inscriptions = Inscription::all();        
        $benefice = Inscription::all()->sum('total');
        $libres = Presence::where('type',1)->get();
        $assurance = Membre::where('assurance',1)->get()->count();
        $assurance = $assurance*1000;  
        $_user = '';

        $users = User::where('grade',3)->get();

        return view('rapport',compact('inscriptions','abonnements','benefice','libres','assurance','users','_user','users'));
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

        if (!empty($request['user'])) {
            $_user=$request['user'];        
            $result = $result->where('user', '=', $request['user']);            
        } 


        if (!empty($request['abonnement'])) {
            $_abonnement  = $request['abonnement'];
            $result = $result->where('abonnement', '=', $request['abonnement']);            
        } 

        $inscriptions = $result->get();
        $libres = $result2->get();
        $benefice = $result->get()->sum('versement');
        $nombreInscriptions = count($inscriptions);
        $assurance = Membre::where('assurance',1)->get()->count();
        $assurance = $nombreInscriptions*1000;
        return view('rapport',compact('inscriptions',
            'date_debut',
            'assurance',
            '_abonnement',
            'libres',
            'date_fin',
            'benefice',
            '_user',
            'users',
            'nombreInscriptions',
            '_coach','_abonnement',
        ));

    }

    public function search(Request $request)
    {

        $wheres = "";
        $index = 0;
        $type = "";
        $debut_entre = "";
        $fin_entre ="";
        if($request['table']){
            $table = $request['table'];
            $categorie = $request['categorie'];
            
            if ($table == 'fournisseurs') {
                $sql ="select * from $table where id in (select fournisseur from categoriquements where categorie='$categorie')";
                $fournisseurs = DB::select(DB::raw($sql));        
                return view('providers',compact('fournisseurs'));                    
            }else{
                $sql ="select * from $table where categorie='$categorie'";
                $produits = DB::select(DB::raw($sql));        
                return view('providers',compact('produits'));    
            }
        }



    }



}

