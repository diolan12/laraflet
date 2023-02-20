<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Connection extends Model
{
    protected $fillable = [
        'from',
        'to',
    ];
    function from() {
        return $this->hasOne('App\\Models\\Location', 'id', 'from');
    }
    function to() {
        return $this->hasOne('App\\Models\\Location', 'id', 'to');
    }
    function break_points() {
        return $this->hasMany('App\\Models\\ConnectionBreakpoint');
    }
    function hops() {
        return $this->hasMany('App\\Models\\Hop');
    }
}
