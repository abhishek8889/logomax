<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogoReview extends Model
{
    use HasFactory;

    public function logo(){
        return $this->hasOne(Logo::class,'id','logo_id');
    }
    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }
}
