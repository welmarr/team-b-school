<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TToolInventoryMovement extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['quantity', 'note', 'type', 'tool_id', 'request_id'];

    public function request(){
        return $this->belongsTo(TRequest::class,'request_id');
    }

    public function tool(){
        return $this->belongsTo(TTool::class,'tool_id');
    }
}
