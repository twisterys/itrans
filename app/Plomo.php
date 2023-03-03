<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plomo extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['num_serie','used_at','traiter_de','traiter_a','defaillante','commentaire','havePlomos_type','havePlomos_id'];

    public function havePlomos(){
        return $this->morphTo();
    }

   
}
