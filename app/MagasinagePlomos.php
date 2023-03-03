<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MagasinagePlomos extends Model
{

    public function magasinage(){
        return $this->belongsTo(Magasinage::class);
    }
}
