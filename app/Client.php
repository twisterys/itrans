<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;


    protected $fillable = ['nom','n_douane','type','date_prem_relation','email','mobile_1','mobile_2','autre_info'];

    public function typeClient(){
        return $this->belongsTo(TypeClient::class,'type');
    }

    public function dossierItems(){
        return $this->hasMany(DossierItem::class,'client_id');
    }

    public function magasinages(){
        return $this->hasMany(Magasinage::class);
    }
}
