<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class DossierItem extends Model
{
    use SoftDeletes;
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'client',
        'importateur',
        'exportateur',
        'transitaire',
        'marchandise',
        'dum',
        'numb_colis',
        'poid_brute',
        'observ',
        'import_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'poid_brut' => 'double',
        'import_id' => 'integer',
    ];


    public function dossier()
    {
        return $this->belongsTo(Dossier::class);
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function transitaire(){
        return $this->belongsTo(Transitaire::class,'transitaire_id');
    }
}
