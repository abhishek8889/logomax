<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';

    public function logodetail(){
        return $this->belongsTo(Logo::class,'logo_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id', 'id');
    }
    public function payment(){
        return $this->hasOne(Payment::class,'order_id','id');
    }
    public function reviosions(){
        return $this->hasMany(LogoRevision::class,'order_id','id');
    }
}
