<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class TypeVehicle extends Model
{
    use Notifiable;
    use SoftDeletes;
    
    protected $fillable = ['name','active'];

    public function dossierVehicle(){
        return $this->hasMany(DossierVehicles::class);
    }
}
