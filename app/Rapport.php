<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Rapport extends Model implements HasMedia
{
    use Notifiable;
    use InteractsWithMedia;

    protected $fillable = ['type','premiere_date','deuxieme_date','date_creation','status'];

    public const TYPE_RAPPORT = [
        'plomos'                    =>  'Plomos',
        'kilometrage_vehicle'       =>  'Kilometrage des vehicules',
        'kilometrage_chauffeur'     =>  'Kilometrage des chauffeurs',
    ];

    public const STATUS = [
        'complet'   =>  'Complet',
        'erreur'    =>  'Erreur',
        
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function getRapportFileAttribute()
    {
        return $this->getMedia('rapport_file');
    }
}
