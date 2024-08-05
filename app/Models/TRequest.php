<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TRequest extends Model
{

    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'memo',
        'estimation',
        'request_group',
        'status',
        'reference',
        'car_id',
        'created_by_type',
        'created_by_id'
    ];

    public function car()
    {
        return $this->belongsTo(TCar::class, 'car_id');
    }

}
