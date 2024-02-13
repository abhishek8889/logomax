<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    protected $table = 'categories';

    public function parent(){
        return $this->hasOne(Categories::class,'id','parent_category');
    }
    public function parent_categories(){
        return $this->hasMany(Categories::class,'parent_category','id');
    }
    public function translation(){
        return $this->hasOne(CategoriesTranslations::class,'category_id','id');
    }
    public function translationBackend(){
        return $this->hasMany(CategoriesTranslations::class,'category_id','id');
    }
}
