<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Transporteur extends Model
{
    use Notifiable;

    protected $fillable = ['identifiant','name','nationnalite'];
}
