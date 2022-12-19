<?php

namespace App;

use App\Http\Controllers\AbonnementController;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use DB;
class Membre extends Model
{
    protected $fillable = [
        'nom',
        'assurance',
        'prenom',
        'telephone',
        'adresse',
        'sexe',
        'naissance',
        'photo',
        'email',
        'matricule',
        'etat'
    ];



    public function getLastPresence()
    {
        $lastpresence = DB::table('presences')
            ->where('id',$this->id)
            ->orderBy('id', 'desc')
            ->first();
        return $lastpresence;

    }

    public static function getActivity()
    {
    $hour = date('H');
    $planning = [];
    $dayName = date('w', strtotime('2019-11-14'));
        if($dayName == 6){
            // lundi
            $planning = [
                '12'=>'Fitness',
                '13'=>'Fitness',
                '18'=>'Strong& zumba',
                '19'=>'Strong& zumba',
            ];

        }
        if($dayName == 5){
            // dimanche
            $planning = [
                '10'=>'Cross fit',
                '11'=>'Cross fit',
                '14'=>'Circuit_training',
                '13'=>'Circuit_training',
                '18'=>'Body_sculpt',
                '19'=>'Body_sculpt',
            ];
        }
        if($dayName == 4){
    
            // samedi
            $planning = [
                '10'=>'Fitness_dance',
                '11'=>'Fitness_dance',
                '13'=>'Ventre plat',
                '14'=>'yoga',
                '18'=>'Box Musculation',
                '19'=>'Box Musculation',
                '19'=>'Box Musculation',
                '17'=>'Cross fit',
                '18'=>'Cross fit'
            ];
        }
        if($dayName == 3){
            // vendredi
            $planning = [
                '10'=>'Fitness_dance',
                '11'=>'Fitness_dance',
                '13'=>'Ventre plat',
                '14'=>'Ventre plat',
                '18'=>'Box Musculation',
                '19'=>'Box Musculation',
                '19'=>'Box Musculation',
                '17'=>'Cross fit',
                '18'=>'Cross fit'
            ];
        }
        if($dayName == 2){
            $planning = [
                '10'=>'Cross fit',
                '11'=>'Cross fit',
                '12'=>'Ventre-plat',
                '13'=>'Ventre-plat',
                '14'=>'Cardio',
                '18'=>'F_A_C',
                '19'=>'F_A_C',
            ];
        }
        if($dayName == 1){
            $planning = [
                '10'=>'Gym_douce',
                '11'=>'Gym_douce',
                '12'=>'Fitness',
                '13'=>'Fitness',
                '14'=>'Cardio',
                '18'=>'Zumba',
                '19'=>'Zumba',
            ];
        }
        if($dayName == 0){
            $planning = [
                '10'=>'Fitness_dance',
                '11'=>'Fitness_dance',
                '13'=>'Cardio',
                '14'=>'Cardio',
                '18'=>'Step',
                '19'=>'Step',
                '17'=>'Cross fit',
                '18'=>'Cross fit'
            ];
        }
        return $planning[$hour] ;
    }
    public function getInscriptions()
    {
        $inscriptions = Inscription::where('membre',$this->id)->get();
        return $inscriptions;
    }

    public function getAbonnement()
    {
        $inscription = Inscription::where(['membre'=>$this->id,'etat'=>1])->first();
        $a = $inscription['abonnement'] ?? 1; 
        $abonnement = Abonnement::find($a);
        return $abonnement;
    }

    public function hasInscription()
    {
        $inscription = Inscription::orderBy('id', 'DESC')->limit(1);
//        $inscription = Inscription::where(['membre'=>$this->id,'etat'=>1])->first();
        if ($inscription){
            return true;
        }
        return false;
    }

    public function getActiveInscription()
    {
        $inscription  = Inscription::where('membre',$this->id)->first();
        return $inscription;
    }
    public function HasActiveInscription()
    {
        $inscription  = Inscription::where(['membre'=>$this->id,'etat'=>1])->first();       
        if($inscription){
            return 1;
        }else{
            return 0;
        }

    }

    public function HasActivity($single)
    {
        $inscription = $this->getActiveInscription();
        $activities  = $inscription->activities;
        
        $res = 0;
        if($activities){
            $activities = json_decode($activities);
            foreach($activities as $activitie){
                if($activitie == $single){
                    $res = 1;
                }
            }
    
        }
        return $res;

    }

    public function isAuthorised()
    {
        $inscription  = Inscription::where(['membre'=>$this->id,'etat'=>1])->first();
        if ($inscription) {

            $fin = $inscription->fin;
            $debut = $inscription->debut;
            $reste = $inscription->reste;
            $current = date('Y-m-d');
            if($current>$fin or $reste==0 or $current<$debut){
                return 0;
            }else{
                return 1;
                // $lastpresence = DB::table('presences')
                //     ->where('id',$this->id)
                //     ->orderBy('id', 'desc')
                //     ->get();
                // $lastpresence = $lastpresence[0];
                // $aftersixhour= date("Y-m-d H:i:s", strtotime($lastpresence->created_at." +6 hours"));
                // $hour=date('Y-m-d H:i:s');                
                // /**
                //  * check if last presnce is more then 6 hours
                //  */
                // if ($hour>$aftersixhour) {
                //     return 1;
                // }else{
                //     return 0;
                // }
            }
        }else{
            return 0;
        }
    }


    public function getLastInscription()
    {
        $inscription = Inscription::where('membre',$this->id)->orderBy('id', 'desc')->first();
        return $inscription;

    }
    
}
