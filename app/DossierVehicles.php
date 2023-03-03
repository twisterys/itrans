<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class DossierVehicles extends Model
{
    use SoftDeletes;
    use Notifiable;

    protected $table = 'dossier_vehicle';

    protected $fillable = [
        'matricule',
        'type',
        'dossier_id'
    ];

    public function dossier(){
        return $this->belongsTo(Dossier::class);
    }

    public function vehicles(){
        return $this->belongsTo(Vehicle::class,'vehicle_id');
    }

    public function TypeVehicle(){
        return $this->belongsTo(TypeVehicle::class,'typeVehicle_id');
    }
}
