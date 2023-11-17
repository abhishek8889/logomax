<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Media;

class Logo extends Model
{
  use HasFactory;

  public function category(){
    return $this->hasOne(Categories::class,'id','category_id');
  }
  public function media(){
    return $this->belongsTo(Media::class,'media_id','id');
  }
  public function userdata(){
    return $this->hasOne(User::class,'id','designer_id');
  }
  public function style(){
    return $this->hasOne(Style::class,'id','style_id');
  }
  public function branches(){
    return $this->hasOne(Branch::class,'id','branch_id');
  }
 
  public function inWhishlist()
  {
      return $this->hasOne(Wishlist::class, 'logo_id');
  }
}
