<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class TypeClient extends Model
{
    use Notifiable,SoftDeletes;

    protected $fillable = ['name','active'];

    public function client(){
        return $this->hasMany(Client::class);
    }
}
