<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class VisiteTechniqueTaco extends Model implements HasMedia
{
    use Notifiable;
    use SoftDeletes;
    use InteractsWithMedia;

    protected $fillable = ['ref','date_last_visit','date_next_visit','taco_id'];


    public function taco(){
        return $this->belongsTo(Taco::class);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function getVisiteTechniqueTacoFileAttribute()
    {
        return $this->getMedia('VisiteTechniqueTaco_file');
    }
}
