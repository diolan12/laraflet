<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use MatanYadaev\EloquentSpatial\SpatialBuilder;
use MatanYadaev\EloquentSpatial\Traits\HasSpatial;
use MatanYadaev\EloquentSpatial\Objects\LineString;

/**
 * @property LineString $line
 * @method static SpatialBuilder query()
 */
class Hop extends Model
{
    use HasSpatial;
    protected $fillable = [
        'connection_id',
        'qrcode',
        'line'
    ];
    protected $casts = [
        'line' => LineString::class
    ];

    public function connection() {
        return $this->belongsTo('App\\Models\\Connection');
    }
}
