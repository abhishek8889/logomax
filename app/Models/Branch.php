<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    public function translation(){
        return $this->hasOne(BranchesTranslations::class,'branch_id','id');
    }
}
