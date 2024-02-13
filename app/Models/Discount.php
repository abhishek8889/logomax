<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    public function translationBackend(){
        return $this->hasMany(DiscountTranslate::class,'discount_id','id');
    }
    public function translation(){
        return $this->hasOne(DiscountTranslate::class,'discount_id','id');
    }
}
