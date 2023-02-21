<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use MatanYadaev\EloquentSpatial\SpatialBuilder;
use MatanYadaev\EloquentSpatial\Traits\HasSpatial;
use MatanYadaev\EloquentSpatial\Objects\Point;

/**
 * @property Point $point
 * @method static SpatialBuilder query()
 */
class Location extends Model
{
    use HasSpatial;
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
    // public function connections(){
    //     return $this->froms()->get()->merge($this->tos()->get());
    // }
    
}
