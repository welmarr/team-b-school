<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TTool extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['name', 'description', 'track_usage', 'condition', 'tool_type_id', 'unit_id', 'enable_tracking_at'];

    public function unit()
    {
        return $this->belongsTo(TUnit::class, 'unit_id');
    }

    public function type()
    {
        return $this->belongsTo(TToolType::class, 'tool_type_id');
    }
    public function inventories()
    {
        return $this->hasMany(TToolInventoryMovement::class, 'tool_id');
    }

    public function calculateStock()
    {
        return $this->inventories()
        ->where(function ($query) {
            $query->whereNull('request_id')
                  ->orWhereHas('request', function ($query) {
                      $query->where('status', '!=', 'canceled');
                  });
        })
        ->sum('quantity');
    }
}
