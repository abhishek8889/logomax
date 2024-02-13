<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    public function user(){
        return $this->hasOne(User::class,'id','created_by');
    }
    public function translation(){
        return $this->hasOne(BlogTranslation::class,'blog_id','id'); 
    }
}
