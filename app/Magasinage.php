<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Magasinage extends Model implements HasMedia
{
    use Notifiable,SoftDeletes;
    use InteractsWithMedia;

    protected $fillable = ['id','date_entree','date_sortie','mat_entree','mat_sortie','depot_id','prix','user_id','num_bon','client_id'];

    public function depot(){
        return $this->belongsTo(Depot::class);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function getMagasinageFileAttribute()
    {
        return $this->getMedia('magasinage_file');
    }

    public function plomos(){
        return $this->morphMany(Plomo::class,'havePlomos');
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }

   
}
