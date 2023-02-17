<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DHopCore extends BaseModel
{
    protected $connection = 'mysql2';

    use HasFactory;
}
