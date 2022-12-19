<?php

namespace App\Http\Controllers;

use App\Fournisseur;
use App\Commune;
use App\Versement;
use App\Wilaya;
use App\Sub;
use App\inscription;
use App\Template;
use App\User;
use Response;
use Auth;
use Dompdf\Dompdf;
use Illuminate\Http\Request;

class VersementController extends Controller
{

    public function print($versement_id)
    {
        $versement = Versement::find($versement_id);
        $dompdf = new Dompdf();
        $html = Template::Bulletin($versement);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4');
        $dompdf->render();
        
        $dompdf->stream("bulletin.pdf", array("Attachment" => false));
        // return view('crenaux.view',compact('produit'));
    }

 
    public function index()
    {
        $versements = Versement::all();
        $users = User::where('grade',3)->get();
        $_abonnement = "";
        $_user = "";
        return view('versements.index',compact('versements','_user','users'));
    }

    public function store(Request $request)
    {
        $versement = new Versement([
            'montant' => $request['montant'],
            'date_versement' => $request['date_versement'], 
            'inscription' => $request['inscription3'], 
            'membre' => $request['membre3'],
            'user' => Auth::user()->id
        ]);
        $versement->save();    
        $inscription = inscription::find($request['inscription3']);
        $inscription->versement = $inscription->versement+$request['montant']; 
        $inscription->save();
        return redirect()->back()->with('success', 'inserted successfuly ! ');
    }
    public function destroy($categorie)
    {
        $categorie = Categorie::find($categorie);
        $categorie->delete();
        return redirect()->route('categorie.index')
            ->with('success', 'supprimé avec succé !');
    }
    /**
     * 
     */

     public function SousstoreAjax(Request $request)
     {
        if($request->ajax()){
            $array = $request['data'];        
            $data=  array();
            parse_str($array, $data);        
            $categorie = new Categorie([
                'label' => $data['label'],
                'categorie'=>$data['categorie']
            ]);
            $categorie->save();    
            $response = array(
                'categorie' => $data,
                'msg' => 'catégorie ajouté',
            );        
            return Response::json($response);  // <<<<<<<<< see this line    
        }
    }
    public function update(Request $request)
    {
        $categorie = Categorie::find($request['id_categorie']);
        $categorie->label = $request['categorie'];
        // $categorie->icon = $request['icon'];
        if($request->file('icon')){
            $file = $request->file('icon');// as $image){
                $icon = $file->store(
                    'categories/icon',
                    'public'
                );
                
                $categorie->icon = $icon;     
            }


        if($request->file('image')){
            $file = $request->file('image');
                $image = $file->store(
                    'categories/images',
                    'public'
                );
                $categorie->image = $image;     
        }
        $categorie->save();
        return redirect()->route('categorie.index')->with('success', 'edited  successfuly ! ');
   }



   public function filter(Request $request)
   {
        $date_fin="";
        $date_debut="";
        $_user = $request['user'];
        $users = User::where('grade',3)->get();

        $result = Versement::query();


        if (!empty($request['date_debut'])) {
            $date_debut=$request['date_debut'];    
            $result = $result->whereDate('date_versement', '>=', $request['date_debut']);
        }

        if (!empty($request['date_fin'])) {
            $date_fin=$request['date_fin'];    
            $result = $result->whereDate('date_versement', '<=', $request['date_fin']);
        }


        if (!empty($request['user'])) {
            $result = $result->where('user', '=', $request['user']);            
        }
        $versements = $result->get();

        return view('versements.index',compact('versements',
            'date_debut',
            'date_fin',
            'users',
            '_user'
        ));


   }
}
