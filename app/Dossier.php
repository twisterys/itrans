<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Dossier extends Model implements HasMedia
{
    use Notifiable;
    use SoftDeletes;
    use InteractsWithMedia;


    public $table = 'dossiers';
    public const TYPE_CHARGEMENT = [
        'vide' => 'Vide',
        'groupage' => 'Groupage',
        'complet' => 'Complet',
    ];

    public const TYPE_SELECT = [
        'import' => 'Import',
        'export' => 'Export',
        'national' => 'National',
    ];

    // protected $appends = [
    //     'import_file',
    //     'export_file',
    //     'national_file',
    // ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date',
        'num_connaissement',
        'compagnie',
        'navire',
        'provenance',
        'destination',
        'date_arrive',
        'date_sortie',
        'observation',
        'tarre',
        'poid_brut',
        'nbr_colis',
        'type_chargement',
        'type',
        'nb_jour_maroc',
        'nb_jour_etranger',
        'kilometrage',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'tarre' => 'double',
        'poid_brut' => 'double',
        'frais_peage' => 'double',
        'frais_TMSA' => 'double',
        'montant_fret' => 'double',
        'devise' => 'double',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function dossierItems(){
        return $this->hasMany(DossierItem::class);
    }
    public function personalExpenses(){
        return $this->hasMany(PersonalExpense::class);
    }

    public function dossierVehicles(){
        return $this->hasMany(DossierVehicles::class);
    }

    public function getImportFileAttribute()
    {
        return $this->getMedia('import_file');
    }
     public function getExportFileAttribute()
    {
        return $this->getMedia('export_file');
    }
     public function getNationalFileAttribute()
    {
        return $this->getMedia('national_file');
    }

    public function plomos(){
        return $this->morphMany(Plomo::class,'havePlomos');
    }

    public function chauffeur(){
        return $this->belongsToMany(Person::class,'dossier_chauffeurs','dossier_id','chauffeur_id');
    }

   
}
