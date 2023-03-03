<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Gasoil extends Model
{

    use Notifiable,SoftDeletes;
    
    protected $fillable = ['date','station','kilometrage','chauffeur','vehicle','prix','qte'];


    public function chauffeur(){
        return $this->belongsTo(Person::class);
    }
    public function station(){
        return $this->belongsTo(Station::class);
    }
}
