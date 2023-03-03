<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class TypeFrais extends Model
{
    use Notifiable;
    use SoftDeletes;
    
    protected $fillable = ['name','active','general_frais_id'];

    public function personalExpenses(){
        return $this->hasMany(PersonalExpense::class);
    }

    public function GeneralFrais(){
        return $this->belongsTo(GeneralFrais::class,'general_frais_id');
    }
}
