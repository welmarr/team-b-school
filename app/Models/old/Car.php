<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{use HasFactory;

    protected $fillable = ['year', 'make_id', 'model_id', 'body_style'];

    public function make()
    {
        return $this->belongsTo(CarMake::class, 'make_id');
    }

    public function model()
    {
        return $this->belongsTo(CarModel::class, 'model_id');
    }
}
