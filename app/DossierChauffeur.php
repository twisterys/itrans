<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class DossierChauffeur extends Model
{
    use Notifiable,SoftDeletes;
}
