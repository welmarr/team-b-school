<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TImage extends Model
{
    use HasFactory, SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'path', 'mime_type', 'size', 'extension', 'folder', 'public_uri', 'take_when', 't_request_id'];

    public function request(){
        return $this->belongsTo(TRequest::class, "t_request_id");
    }
}
