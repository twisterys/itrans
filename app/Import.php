<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Import extends Model implements HasMedia
{
    use InteractsWithMedia;

    public const TYPE_CHARGEMENT = [
        'vide' => 'Vide',
        'groupage' => 'Groupage',
        'complet' => 'Complet',
    ];

    protected $appends = [
        'import_file',
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'manifeste',
        'num_EORI',
        'date',
        'num_connaissement',
        'driver',
        'mat_camion',
        'mat_remorque',
        'mat_contenaire',
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
        'cours',
        'type',
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

    public function importItems(){
        return $this->hasMany(ImportItem::class);
    }
    public function personalExpenses(){
        return $this->hasMany(PersonalExpense::class);
    }

    public function importVehicles(){
        return $this->hasMany(ImportVehicles::class);
    }

    public function getImportFileAttribute()
    {
        return $this->getMedia('import_file');
    }
}
