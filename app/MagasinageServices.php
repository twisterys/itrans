<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class MagasinageServices extends Model
{
    use SoftDeletes;
    use Notifiable;

    protected $fillable = [
        'price',
        'comment',
        'service_id',
        'magasinage_id'
    ];

    public function service(){
        return $this->belongsTo(Service::class);
    }
}
