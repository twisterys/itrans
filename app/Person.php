<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Person extends Model implements HasMedia
{

    use Notifiable;
    use SoftDeletes;
    use InteractsWithMedia;

    public const SITUATION_FAMILIALE = [
        'celibataire' => 'Célibataire',
        'marie' => 'Marié(e)',
        'divorce' => 'Divorcé(e)',
    ];
    public const NATIONALITE = [
        'marocaine' => 'Marocaine',
        'algerienne' => 'Algérienne',
        'tunisienne' => 'Tunisienne',
    ];

    public const TRANSPORT = [
        'camion' => 'Camion',
        'van' => 'Van',
        'caravane' => 'Caravane',
        'mini-camion' => 'Mini camion',
        'grop-camion' => 'Gros camion',
    ];
    public const SEXE = [
        'homme' => 'Homme',
        'femme' => 'Femme',
    ];
    public const FONCTION = [
        'chauffeur' => 'Chauffeur',
        'rh' => 'RH',
        'directeur' => 'Directeur',
    ];
    public const SECTION = [
        'administration' => 'Administration',
        'transport' => 'Transport',
        'technique' => 'Technique',
    ];
    public const MODE_REGLEMENT = [
        'something'=> 'Something'
    ];
    public const BANK_SELECT = [
        'bcme' => 'bmce',
        'bq'   => 'Banque Populaire',
        'wafa' => 'Attijari WafaBank',
        'cih'  => 'CIH',
        'bmci' => 'bmci',
        'cash' => 'CASH',
    ];
    public const RETRAITE = [
        'public' => 'Public',
        'privee' => 'Privée',
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'matricule',
        'categorie',
        'nom',
        'prenom',
        'date_naiss',
        'situation_familiale',
        'nationalite',
        'cin',
        'nbre_enfant',
        'tele',
        'sexe',
        'nb_deduction',
        'transport',
        'adress',
        'ville',
        'fonction',
        'section',
        'date_embauche',
        'date_depart',
        'salaire_base',
        'taux_horaire',
        'banque',
        'N_Cmp_Banc',
        'mode_reglement',
        'prime_presentation',
        'prime_panier',
        'prime_logement',
        'retraite',
        'cnss',
        'date_affiliation',
        'type',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'salaire_base' => 'double',
        'salaire_horaire' => 'double',
        'prime_presentation' => 'double',
        'prime_panier' => 'double',
        'prime_logement' => 'double',
    ];

    public function gasoil(){
        return $this->hasMany(Gasoil::class);
    }

    public function dossier(){
        return $this->belongsToMany(Dossier::class,'dossier_chauffeurs','chauffeur_id','dossier_id');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function getPersonFileAttribute()
    {
        return $this->getMedia('person_file');
    }
    
}
