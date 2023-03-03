<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Vente extends Model
{
    use Notifiable,SoftDeletes;

    public const PAY_STATUS_SELECT = [
        'unpaid'    => 'Non Payé',
        'paid'      => 'Payé',
        'cancelled' => 'Annulé',
        'partially_paid' => 'Partiellement payé',
    ];
    protected $fillable = [
        'reference',
        'montant_ht',
        'montant_ttc',
        'tax',
        'paiement_statut',
        'vente_date',
        'echeance_date',      
        'client_id',
        'created_by',
        'note',
        'facturer'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class,'client_id');
    }
    public function createdBy()
    {
        return $this->belongsTo(User::class,'created_by');
    }

    public function venteitems()
    {
        return $this->hasMany(VenteItem::class,'vente_id');
    }

    public function schema(){
        return $this->belongsTo(Shema::class,'shema_id');
    }
}
