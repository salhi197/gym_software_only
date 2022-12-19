<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Abonnement extends Model
{
    protected $fillable = [
        'label',
        'activity',
        'tarif',
        'duree',
        'type',
        'nbrsemaine',
    ];
}
