<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Transitaire extends Model
{
    use Notifiable,SoftDeletes;

    protected $fillable = [
        'nom',
        'ice',
        'numero',
        'email',
        'adress',
    ];
}
