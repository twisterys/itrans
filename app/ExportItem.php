<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExportItem extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'client',
        'importateur',
        'exportateur',
        'transitaire',
        'marchandise',
        'dum',
        'numb_colis',
        'poid_brute',
        'observ',
        'export_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'poid_brute' => 'double',
        'export_id' => 'integer',
    ];


    public function export()
    {
        return $this->belongsTo(\App\Export::class);
    }
}
