<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Shema extends Model
{
    use Notifiable,SoftDeletes;

    protected $fillable = ['nom','type','start_from','prefix','suffix','template','footer','letterscount','current','date'];

    public const TYPE_SELECT = [
        'facture'    => 'Facture',
        'vente'      => 'Vente',
    ];

    public function factures(){
        $this->hasMany(Facture::class,'shema_id');
    }
}

