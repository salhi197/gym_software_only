<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $fillable = [
        "categorie",
        "designation",
        "setting"
    ];
    public function getCategorie()
    {
        return Categorie::where('id',$this->categorie)->first();
    }
    public function getSettings()
    {
        $settings=json_decode($this->setting);        
        return $settings;
    }
    
}
