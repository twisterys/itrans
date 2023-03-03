<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Export extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'num_EORI',
        'date',
        'driver',
        'mat_camion',
        'mat_remorque',
        'mat_contenaire',
        'compagnie',
        'navire',
        'provenance',
        'destination',
        'date_chargement',
        'date_embarque',
        'observation',
        'tarre',
        'poid_brut',
        'nbr_colis',
        'frais_peage',
        'frais_TMSA',
        'montant_fret',
        'devise',
        'cours',
        'type',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'tarre' => 'double',
        'poid_brut' => 'double',
        'frais_peage' => 'double',
        'frais_TMSA' => 'double',
        'montant_fret' => 'double',
        'devise' => 'double',
    ];

    public function exportItems(){
        return $this->hasMany(ExportItem::class);
    } 

    public function personalExpense(){
        return $this->hasOne(PersonalExpense::class);
    }
}
