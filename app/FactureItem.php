<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class FactureItem extends Model
{
    use Notifiable,SoftDeletes;

    protected $fillable = [
        'nom',
        'tax',
        'montant_ht',
        'qte',
        'prix_unitaire',
        'description',
        'facture_id',
    ];

    public function facture()
    {
        return $this->belongsTo(Facture::class);
    }
}
