<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class GeneralFrais extends Model
{
    use Notifiable,SoftDeletes;

    public const TYPE_FRAIS = [
        'maroc' => 'Maroc',
        'etranger' => 'Etranger',
    ];

    public function Type_Frais(){
        return $this->hasMany(TypeFrais::class);
    }
}
