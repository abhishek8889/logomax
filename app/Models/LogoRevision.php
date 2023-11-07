<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogoRevision extends Model
{
    use HasFactory;
    public function logoDetail(){
        return $this->belongsTo(Logo::class,'logo_id');
    }
    public function orderDetail(){
        return $this->belongsTo(Order::class,'order_id');
    }
    public function customerDetail(){
        return $this->belongsTo(User::class,'client_id');
    }
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
    public function assignedTaskList(){
        return $this->hasMany(SpecialDesignerTask::class,'logo_revision_id','id');
    }
    
}
