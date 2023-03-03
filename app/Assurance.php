<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Assurance extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;

   

    public const TYPE_ASSURANCE = [
        'national' => 'National',
        'international' => 'International',
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'date',
        'expiration',
        'assurance_international',
        'assureur',
        'police',
        'vehicle_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'vehicle_id' => 'integer',
    ];


    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }


    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function getAssuranceFileAttribute()
    {
        return $this->getMedia('assurance_file');
    }
}
