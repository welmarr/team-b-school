<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TRequestHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'status',
        'request_id',
        'data'
    ];

}
