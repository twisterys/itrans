<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Service extends Model
{
    use Notifiable;
    use SoftDeletes;

    protected $fillable = ['service','service_price','service_comment'];

    public function magasinages(){
        return $this->hasMany(Magasinage::class);
    }
}
