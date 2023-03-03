<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VenteItem extends Model
{
    protected $fillable = [
        'nom',
        'tax',
        'montant_ht',
        'qte',
        'prix_unitaire',
        'description',
        'vente_id',
    ];

    public function vente()
    {
        return $this->belongsTo(Vente::class);
    }
}
