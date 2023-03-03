<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class PersonalExpense extends Model
{

    use SoftDeletes;
    use Notifiable;

    protected $table = 'personal_expenses';

    public const TYPE_FRAIS = [
        'frais_peage' => 'Frais Peage',
        'frais_TMSA' => 'Frais TMSA',
        'frais_auto' => 'Frais Auto',
        'frais_tele' => 'Frais Tele',
        'frais_gasoil' => 'Frais Gasoil',
    ];

    public const DEVISE = [
        'mad' => 'MAD',
        'euro' => 'EURO',
        'usd' => 'USD',
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type_frais',
        'montant',
        'devise',
        'dossier_id',
        'typeFrais_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'type_frais'    => 'string',
        'montant'   => 'double',
        'devise'    => 'string',
        'dossier_id'    => 'integer',
        'typeFrais_id'  => 'integer',
    ];


    public function dossier()
    {
        return $this->belongsTo(Dossier::class,'dossier_id');
    }

    public function export()
    {
        return $this->belongsTo(Export::class);
    }

    public function national()
    {
        return $this->belongsTo(National::class);
    }

    public function TypeFrais(){
        return $this->belongsTo(TypeFrais::class,'typeFrais_id');
    }


}
