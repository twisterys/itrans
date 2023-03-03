<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DossierPlomos extends Model
{
    protected $table = 'dossier_plomos';

    public function dossier(){
        return $this->belongsTo(Dossier::class);
    }
}
