<?php

namespace App\Http\Controllers;

use App\Inscription;
use Redirect;
use DataTables;
use Dompdf\Dompdf;

use DB;
use Auth;
use App\User;
use App\Template;
use App\Crenau;
use App\Presence;
use Carbon\Carbon;
use App\Membre;
use App\Abonnement;
use App\Versement;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Route;

class MembreController extends Controller
{
    public function indexAjax()
    {
        return view('membres.index-ajax',compact('hommes','femmes'));
    }


    public function getMembers(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page
   
        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');
   
        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value
   
        // Total records
        $totalRecords = Membre::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Membre::select('count(*) as allcount')
                ->where('id', 'like', '%' .$searchValue . '%')
                ->orWhere('nom', 'like', '%' .$searchValue . '%')
                ->orWhere('prenom', 'like', '%' .$searchValue . '%')
                ->orWhere('telephone', 'like', '%' .$searchValue . '%')
                ->orWhere('matricule', 'like', '%' .$searchValue . '%')
                ->count();
   
        // Fetch records
        $records = Membre::orderBy($columnName,$columnSortOrder)
        ->where('id', 'like', '%' .$searchValue . '%')
        ->orWhere('nom', 'like', '%' .$searchValue . '%')
        ->orWhere('prenom', 'like', '%' .$searchValue . '%')
        ->orWhere('telephone', 'like', '%' .$searchValue . '%')
        ->orWhere('matricule', 'like', '%' .$searchValue . '%')
          ->select('membres.*')
          ->skip($start)
          ->take($rowperpage)
          ->get();
   
        $data_arr = array();
        foreach($records as $record){
              $data_arr[] = array(
             "id" => $record->id,
             'nom' => $record->nom,
             'telephone' => $record->telephone,
             'matricule' => $record->matricule,
             'prenom' => $record->prenom,
           );
        }
   
        $response = array(
           "draw" => intval($draw),
           "iTotalRecords" => $totalRecords,
           "iTotalDisplayRecords" => $totalRecordswithFilter,
           "aaData" => $data_arr
        );
   
        echo json_encode($response);
        exit;
      }

    public function index()
    {
        $membres = Membre::orderBy('id', 'DESC')->get();
        
        $hommes = Membre::where('sexe', 'homme')->get();
        $femmes = Membre::where('sexe', 'femme')->get();

        $abonnements = Abonnement::all();
        // $coachs = User::where('grade',3)->get();

        return view('membres.index',compact('membres','abonnements','hommes','femmes'));
    }



    public function inscriptions($membre_id)
    {
        $membre = Membre::find($membre_id);
        $inscriptions = $membre->getInscriptions();
        $abonnements = Abonnement::all();        
        return view('membres.inscriptions',compact('membre','inscriptions','abonnements'));
    }


    public function filter(Request $request)
    {

        $result = Membre::query();
        $_abonnement= $request['abonnement'];
        $_coach= $request['coach'];
        
               
        if (!empty($request['coach'])) {
            
            $result = $result->where('coach', '=', $request['coach']);            
        } 
        $membres = $result->get();
        $abonnements = Abonnement::all();
        $coachs = User::where('grade',3)->get();
        $total= 0;
        foreach ($membres as $membre) {
            if($membre->getAbonnement()['id'] == $_abonnement){
                $total++;
            }
        }
        return view('membres.index_filter',compact('membres','abonnements','coachs','_coach','_abonnement','total'));        
    }


    public function create()
    {
        $abonnements = Abonnement::all();
        $crenaus = Crenau::all();
        $coachs = User::where('grade',3)->get();
        
        return view('membres.create',compact('abonnements','crenaus','coachs'));
        
    }

    public function store(Request $request)
    {                  
        $m=(int)$request['matricule'];
        $validated = $request->validate([
            'nbrmois'=>'required',
            'abonnement'=>'required',
            'matricule' => 'unique:membres'
        ]);
        if($m == 0){
            return Redirect::back()->with('error', 'Erreur dans la saisie du matricule');
        }
        $checkMembre = Membre::where('matricule',$m)->first();
        if(!is_null($checkMembre)){
            return Redirect::back()->with('error', 'Puce D??ja Prise');
        }
        $membre = new Membre();
        $membre->nom = $request['nom'];
        $membre->matricule = $m;
        $membre->identite = $request['identite'];
        $membre->prenom = $request['prenom'];
        $membre->assurance = $request['assurance'];
        $membre->telephone = $request['telephone'];
        $membre->adresse = $request['adresse'];
        $membre->sexe = $request['sexe'];
        $membre->naissance = $request['naissance'];
        $membre->photo = $request['photo'];
        $membre->email = $request['email'];
        $membre->sang = $request['sang'];        
        $encoded_data = $request['mydata'];
        


        $cn = 1;
        $dm = 1;
        if($request['cn'] == null){
            $cn = 0;
        }
        if($request['dm'] == null){
            $dm = 0;
        }

        $membre->cn = $cn;
        $membre->dm = $dm;



        if ($request['mydata']) {
            $membre->source = 2;
            $code = str_random(15).'.jpg';
            $binary_data = base64_decode( $encoded_data );
            $result = file_put_contents($code, $binary_data );
            // dd($code);
            $membre->photo = $code;
        }
        if($request->file('photoMembre')){
            try {
                $path = $request->file('photoMembre')->storeAs('/images');                
            } catch (Exception $e) {
                return Redirect::back()->withInput()->with('error', 'Images Tr??s grande');                
            }
            $membre->photo = $path;
            $membre->source = 1;

         }
        try {
            $membre->save();
        } catch (\Throwable $th) {
            return Redirect::back()->withInput()->with('error', $th->getMessage());
        }
        /**
         * ajouter inscrtion 
         */
        $inscription = new Inscription();
        // ::find($['inscription']);
        $inscription->debut=$request['debut'];
        $inscription->sexe=$request['sexe'];
        // $inscription->type=$request['type'];
        $activities = $request->input('activities');
        $inscription->activities=json_encode($activities);

        $fin =  Carbon::parse($request['debut'])->addMonth($request['nbrmois'])->format('Y-m-d');
        $inscription->fin=$fin;
        
        $inscription->nbsseance=$request['nbrmois']*4*json_decode($request['abonnement'])->nbrsemaine;
        $inscription->reste=$request['nbrmois']*4*json_decode($request['abonnement'])->nbrsemaine;
        

        $inscription->membre=$membre->id;
        $inscription->abonnement=json_decode($request['abonnement'])->id;
        $inscription->etat=1;
        $inscription->total=$request['total'];
        $inscription->remise=$request['remise'];
        // $inscription->coach=$request['coach'];
        $inscription->nbrmois=$request['nbrmois'];
        $inscription->user=Auth::user()->id;
        $inscription->versement=$request['versement'];
        
        $inscription->save();

        /**/
        $versement = new Versement([
            'montant' => $request['versement'],
            'date_versement' => date('y-m-d'), 
            'inscription' => $inscription->id, 
            'membre' => $membre->id,
            'user' => Auth::user()->id
        ]);
        $versement->save(); 



        $versement = Versement::find($versement->id);
        $dompdf = new Dompdf();
        $html = Template::Bulletin($versement);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4');
        $dompdf->render();
        
        // $dompdf->stream("bulletin.pdf", array("Attachment" => false));

        
        return redirect()->route('membre.create')->with('success', ' ins??r?? avec succ??s ');        
    }

    public function show($id_membre)
    {
        $membre = Membre::find($id_membre);
        return view('membres.view',compact('produit'));
    }

    public function membre($id_membre)
    {
        $abonnements = Abonnement::all();
        $membre= Membre::where('matricule',$id_membre)->first();
        if(is_null($membre)){
            return redirect()->route('membre.default')->with('success', ' Carte n\'exsite pas  ');        
        }
        $inscription = $membre->getLastInscription();//Inscription::where(['membre'=>$membre->id,'etat'=>1])->first();
        
        $inscriptions = Inscription::where(['membre'=>$membre->id,'etat'=>1])->get();
        // dd($inscription);
        return view('membres.membre',compact('abonnements','membre','inscription','inscriptions'));    

    }



    public function compte($id_membre)
    {
        $abonnements = Abonnement::all();
        
        $membre= Membre::where('matricule',$id_membre)->first();
        if(is_null($membre)){
            return redirect()->route('home')->with('success', ' Carte n\'exsite pas  ');        
        }
        $inscription = $membre->getLastInscription();
// dd($inscription);
        //Inscription::where(['membre'=>$membre->id,'etat'=>1])->first();
        if($inscription->reste!=0){
            $inscription->reste = $inscription->reste - 1;
        }
        $inscription->save();   
        $presence = new Presence();        
        $presence->type = 1;
        $presence->membre = $membre->id;        
        $presence->inscription = $inscription->id;
        $presence->save();

        $inscriptions = Inscription::where(['membre'=>$membre->id,'etat'=>1])->get();




        // dd($inscription);
        return view('membres.edit',compact('abonnements','membre','inscription','inscriptions'));    

        // if ($membre) {
        // }
    }




    public function edit($id_membre)
    {
        $abonnements = Abonnement::all();   
        $membre= Membre::where('matricule',$id_membre)->first();
        if(is_null($membre)){
            return redirect()->route('home')->with('success', ' Carte n\'exsite pas  ');        
        }
        $inscription = $membre->getLastInscription();
        $inscriptions = Inscription::where(['membre'=>$membre->id,'etat'=>1])->get();
        $coachs = User::where('grade',3)->get();
        return view('membres.edit',compact('abonnements','membre','inscription','inscriptions','coachs'));    
    }

    public function profile($id_membre)
    {
        $abonnements = Abonnement::all();
        $membre= Membre::find($id_membre);
        dd($membre);
        if (is_null($membre)) {
            return redirect()->route('membre.index')->with('success', ' ins??r?? avec succ??s ');        
        }else{
            $inscription = $membre->getLastInscription();
            $inscriptions = Inscription::where(['membre'=>$membre->id,'etat'=>1])->get();
            // dd($inscription);
            return view('membres.profile',compact('abonnements','membre','inscription','inscriptions'));                
        }
    }

    
    public function verifier($matricule)
    {   
        $matricule = substr($matricule, 0, -2);
        $membre=Membre::where('matricule',$matricule)->first();
        $reponse = $membre->isAuthorised();
    }


    public function update(Request $request,$membre_id)
    {
        $membre = Membre::find($membre_id);  
        if((int)$request['matricule'] == 0){
            return Redirect::back()->with('error', 'Erreur dans la saisie du matricule');
        }
        $m = Membre::where([
            ['id','<>',$membre_id],
            ['matricule','=',(int)$request->matricule],
        ])->first();
        if(!is_null($m)){
            return Redirect::back()->with('error', 'Matricule Deja Pris');
        }
        $validated = $request->validate([
            'matricule' => 'required',
            'abonnement'=>'required',
        ]);

        $membre->matricule = (int)$request['matricule'];
        $membre->nom = $request['nom'];
        // $membre->coach = $request['coach'];
        $membre->prenom = $request['prenom'];
        $membre->telephone = $request['telephone'];
        $membre->adresse = $request['adresse'];
        $membre->sexe = $request['sexe'];

        $membre->naissance = $request['naissance'];
        $membre->identite = $request['identite'];
        $membre->sang = $request['sang'];

        if($request->file('image')){
            try {
                $path = $request->file('image')->store('/images');
            } catch (Exception $e) {
                return Redirect::back()->withInput()->with('error', 'Images Tr??s grande');                
            }

            $membre->source = 1;
            $membre->photo = $path;
        }

        $cn = 1;
        $dm = 1;
        if($request['cn'] == null){
            $cn = 0;
        }
        if($request['dm'] == null){
            $dm = 0;
        }

        $membre->cn = $cn;
        $membre->dm = $dm;
         

        $encoded_data = $request['mydata'];
        // dd($binary_data);
        if ($request['mydata']) {
            $code = str_random(15).'.jpg';
            $binary_data = base64_decode( $encoded_data );
            $result = file_put_contents($code, $binary_data );
            // dd($code);
            $membre->photo = $code;
            $membre->source = 2;
        }

        try {
            $membre->save();            
        } catch (\Throwable $th) {
            return Redirect::back()->withInput()->with('error', $th->getMessage());
        }
        $inscription = Inscription::find($request['inscription_id']);
        $inscription->debut=$request['debut'];
        $inscription->remarque=$request['remarque'];
        $inscription->sexe=$request['sexe'];
        $activities = $request->input('activities');
        $inscription->activities=json_encode($activities);

        $fin =  Carbon::parse($request['debut'])->addMonth($request['nbrmois'])->format('Y-m-d');
        $inscription->fin=$fin;
        
        $inscription->nbsseance=$request['nbrmois']*4*json_decode($request['abonnement'])->nbrsemaine;
        $inscription->reste=$request['reste22'];//*4*json_decode($request['abonnement'])->nbrsemaine;
        if(json_decode($request['abonnement'])->id != $inscription->abonnement){
        $inscription->nbsseance=$request['nbrmois']*4*json_decode($request['abonnement'])->nbrsemaine;
        $inscription->reste=$request['reste22'];//*4*json_decode($request['abonnement'])->nbrsemaine;

        }
        // $inscription->membre=$membre->id;
        $inscription->abonnement=json_decode($request['abonnement'])->id;
        // $inscription->etat=1;
        $inscription->total=$request['total'];
        // $inscription->coach = $request['coach'];

        $inscription->remise=$request['remise'];
        $inscription->nbrmois=$request['nbrmois'];
        $inscription->versement=$request['versement'];
        
        $inscription->save();

        return redirect()->route('membre.index')->with('success', ' ins??r?? avec succ??s ');        

    }

    public function destroy($id_membre)
    {
        $membre = Membre::where('matricule',$id_membre)->first();
        $id = $membre->id;
        // $membre->matricule = 0;
        $membre->delete();
        //Inscription::where('membre',$id)->delete();
        // $affected = DB::table('membres')
        //     ->where('id',$id_membre)
        //     ->update(['matricule' => 0]);
        return redirect()->route('membre.index')->with('success', 'Le Member a ??t?? supprim?? ');        
    }

    public function plus($id_membre)
    {
        $membre = Membre::find($id_membre);
        $inscription = Inscription::where(['membre'=>$membre->id,'etat'=>1])->first();
        $inscription->reste = $inscription->reste + 1;
        $inscription->save();
        return redirect()->back()->with('success', 'success');        
    }
    public function minus($id_membre)
    {
        $membre = Membre::find($id_membre);
        $inscription = Inscription::where(['membre'=>$membre->id,'etat'=>1])->first();
        if($inscription->reste!=0){
            $inscription->reste = $inscription->reste - 1;
        }
        $inscription->save();
        return redirect()->back()->with('success', 'success');        
    }


    public function default()
    {
        return view('membres.default');
    }


    // public function getMembers(Request $request)
    // {
    //     // $data = Membre::select('*');
    //     $data = DB::table('membres')
    //         ->where('matricule','<>',0)
    //         ->join('inscriptions', 'membres.id', '=', 'inscriptions.membre')
    //         ->join('abonnements', 'inscriptions.abonnement', '=', 'abonnements.id')
    //         ->select('*','membres.id as m_id')
    //         ->get();
        
    //     return Datatables::of($data)
    //             ->addIndexColumn()
    //             ->addColumn('action', function($row){
   
    //                    $btn = '<a class="btn bubbly-button text-white" href="'.route('membre.edit',['membre'=>$row->m_id]).'">Modifier <i class="fa fa-edit"></i></a>';
    //                    $btn = $btn.'<a class="btn bubbly-button text-white" onclick="return confirm("Etes vous sure ?")" href="'.route('membre.destroy',['membre'=>$row->m_id]).'"><i class="fa fa-trash"></i> Supprimer</a>';
    //                    $btn = $btn.'<a href="'.route('membre.membre',['membre'=>$row->m_id]).'" class="btn bubbly-button text-white">Profile</a>';
     
    //                     return $btn;
    //             })
    //             ->rawColumns(['action'])
    //             ->make(true);

    // }
   public function versements($inscription)
   {
    $users = User::where('grade',3)->get();
    $versements = Versement::where('inscription',$inscription)->get();
    $_user = "";
    return view('versements.index',compact('versements','users','_user'));
}

}
