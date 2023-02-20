<?php

namespace App\Models;

use MatanYadaev\EloquentSpatial\Objects\Point;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'name',
        'abbreviation',
        'type',
        'point'
    ];
    protected $casts = [
        'point' => Point::class
    ];

    public function froms() {
        return $this->hasMany('App\\Models\\Connection', 'from', 'id');
    }
    public function tos() {
        return $this->hasMany('App\\Models\\Connection', 'to', 'id');
    }
    public function connections(){
        return $this->froms()->get()->merge($this->tos()->get());
    }
    
}
