<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory, SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['address_line_1','address_line_2','city', 'state', 'zip', 'country', 'morph_id', 'morph_type'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array<int, string>
     */
    protected $dates = ['created_at','updated_at', 'deleted_at'];
}
