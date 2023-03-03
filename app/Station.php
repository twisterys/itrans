<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Station extends Model
{
    use Notifiable;
    use SoftDeletes;

    protected $fillable = ['nom','ville','adress'];

    public function gasoil(){
        return $this->hasMany(Gasoil::class);
    }
}
