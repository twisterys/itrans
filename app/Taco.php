<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Taco extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'num_homologation',
        'marque',
        'type',
        'num_serie',
        'date_validation',
        'date_expiration',
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

    public function visitTechnique(){
        return $this->hasMany(VisiteTechniqueTaco::class);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function getTacoFileAttribute()
    {
        return $this->getMedia('taco_file');
    }
}
