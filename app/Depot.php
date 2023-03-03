<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Depot extends Model
{
    use Notifiable,SoftDeletes;

    protected $fillable = ['id','nom','ville'];

    public function magasinages(){
        return $this->hasMany(Magasinage::class);
    }
}
