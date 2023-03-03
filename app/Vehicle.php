<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Vehicle extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;

   

    protected $hidden = ['vehicle_file'];

    public const TYPE_VEHICLE = [
        'camion' => 'Camion',
        'remorque' => 'Remorque',
        'contenaire' => 'Contenaire',
        'van' => 'Van',
        'caravane' => 'Caravane',
        'mini-camion' => 'Mini camion',
        'grop-camion' => 'Gros camion',
    ];
    public const TYPE_CARBURANT = [
        'diesel' => 'Diesel',
        'essence' => 'Essence',
        'carburants-gazeux' => 'Carburants gazeux', 
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'N_immatriculation',
        'immat_anterieur',
        'date_pre_mise_circul',
        'date_m_c_maroc',
        'date_mutation',
        'date_debut_validite',
        'usage',
        'proprietaire',
        'adress',
        'marque',
        'type',
        'modele',
        'genre',
        'num_chassis',
        'type_carburant',
        'puissance_fiscale',
        'nbr_cylindre',
        'nbr_place',
        'P_T_A_C',
        'poids_a_vide',
        'P_T_M_C_T',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    public function assurances(){
        return $this->hasMany(Assurance::class);
    }

    public function technicalVisits(){
        return $this->hasMany(TechnicalVisit::class);
    }

    public function tacos(){
        return $this->hasMany(Taco::class);
    }

    public function extinteurs(){
        return $this->hasMany(Exctinteur::class);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function getVehicleFileAttribute()
    {
        return $this->getMedia('vehicle_file');
    }

    public function dossierVehicle(){
        return $this->hasMany(DossierVehicles::class);
    }

}
