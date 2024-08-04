<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TSocialMediaPost extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['message', 'api_return', 't_request_id'] ;


    public function request(){
        return $this->belongsTo(TRequest::class, "t_request_id");
    }
}
