<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TCarBrand extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name'];

    public function cars()
    {
        return $this->hasMany(TCar::class, 'brand_id');
    }
}
