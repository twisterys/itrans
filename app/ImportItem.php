<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImportItem extends Model
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
        'import_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'poid_brut' => 'double',
        'import_id' => 'integer',
    ];


    public function import()
    {
        return $this->belongsTo(Import::class);
    }
}
