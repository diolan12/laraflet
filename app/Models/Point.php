<?php

namespace App\Models;

class Point extends BaseModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'latlng'
    ];

    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        
    ];

    protected $spatialFields = [
        'latlng'
    ];

    public function multi() {
        return $this->belongsTo('App\Models\Multi');
    }
}
