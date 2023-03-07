<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class TypePackaging extends Model
{
    use Notifiable;
    use SoftDeletes;

    protected $fillable = ['name','active'];

    public function magasinages(){
        return $this->hasMany(Magasinage::class);
    }
}
