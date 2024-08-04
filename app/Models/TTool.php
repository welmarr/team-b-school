<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TTool extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['name', 'description', 'track_usage', 'condition', 't_tool_type_id', 't_unit_id'];
}
