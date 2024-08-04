<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TCarBrand extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['year', 'car_brand_id', 'car_model_id', 'body_style'];

    public function brand()
    {
        return $this->belongsTo(TCarBrand::class, 'car_brand_id');
    }

    public function model()
    {
        return $this->belongsTo(TCarModel::class, 'car_model_id');
    }
}
