<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TPageVariable extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['ref', 'value', 'icon', 't_page_id'];

    public function page(){
        return $this->belongsTo(TPage::class, 't_page_id');
    }
}
