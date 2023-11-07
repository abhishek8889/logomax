<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialDesignerTask extends Model
{
    use HasFactory;
    protected $table = "special_designer_tasks";
    
    public function revisionRequestDetail(){
        return $this->belongsTo(LogoRevision::class,'logo_revision_id');
    }

    public function logoDetail(){
        return $this->belongsTo(Logo::class,'logo_id');
    }

    public function clientDetail(){
        return $this->belongsTo(User::class,'client_id');
    }

    public function completeTask(){
        return $this->hasOne(CompletedTask::class,'task_id','id');
    }

}
