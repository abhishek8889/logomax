<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logo extends Model
{
    use HasFactory;

    public function category(){
      return $this->hasOne(Categories::class,'id','category_id');
    }
    public function media(){
        return $this->hasOne(Media::class,'id','media_id');
      }
  
}
