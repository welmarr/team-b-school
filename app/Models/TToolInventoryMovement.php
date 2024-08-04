<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TToolInventoryMovement extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['quantity', 'note', 'type', 't_tool_id', 't_request_id'];

    public function request(){
        return $this->belongsTo(TRequest::class,'t_request_id');
    }

    public function tool(){
        return $this->belongsTo(TTool::class,'t_tool_id');
    }
}
