<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TermCondition extends Model
{
    use HasFactory;

    public function childs(){
        return $this->hasMany(TermCondition::class,'parent','id');
    }
}
