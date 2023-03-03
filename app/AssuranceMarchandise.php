<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class AssuranceMarchandise extends Model implements HasMedia
{

    use Notifiable,SoftDeletes;
    use InteractsWithMedia;

    protected $fillable = [
        'type',
        'date',
        'expiration',
        'assureur',
        'police',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function getAssuranceMarchandiseFileAttribute()
    {
        return $this->getMedia('assurance_marchandise_file');
    }
    
}
