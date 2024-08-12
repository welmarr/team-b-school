<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TCar extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['year', 'brand_id', 'model_id', 'body_style'];

    public function brand()
    {
        return $this->belongsTo(TCarBrand::class, 'make_id');
    }

    public function model()
    {
        return $this->belongsTo(TCarModel::class, 'model_id');
    }
}
