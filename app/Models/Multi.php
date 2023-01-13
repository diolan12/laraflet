<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Point;

class Multi extends BaseModel
{

    public function points() {
        return $this->hasMany('App\Models\Point', 'multi_id', 'id');
    }
}
