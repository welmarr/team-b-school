<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TPage extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['name', 'description', 'icon'];

    public function variables(){
        return $this->hasMany(TPageVariable::class, 't_page_id');
    }
}
