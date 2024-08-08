<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\TTool as Authenticatable;

class TTool extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;


     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 
        'description', 
        'track_usage', 
        'condition', 
        'tool_type_id', 
        'unit_id'
    ];


    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];
    }

    /**
     * Get the tool type associated with the tool.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tooltype(): HasOne
    {
        return $this->hasOne(TToolType::class);
    }

    /**
     * Get the units associated with the tool.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function unitid(): HasOne
    {
        return $this->hasOne(TUnit::class);
    }






}
