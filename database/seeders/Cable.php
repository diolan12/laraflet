<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use MatanYadaev\EloquentSpatial\Objects\MultiPoint;
use MatanYadaev\EloquentSpatial\Objects\Point;

class Cable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // [-8.364409, 114.146513],
        // [-8.364223388060376, 114.14744199589629],
        // [-8.372725683803404, 114.1453672982199],
        // [-8.378468078124511, 114.14610878648799],
        // [-8.382713786521965, 114.1463877304072],
        // [-8.38999, 114.144079]
        DB::table('cables')->insert([
            [
                'name' => "RJ01",
                'line' => DB::raw("(GeomFromText('" .
                    new MultiPoint([
                        new Point(-8.364409, 114.146513, 4326),
                        new Point(-8.373883, 114.159279, 4326)
                    ])
                    . "'))")
            ],
            [
                'name' => "RJ44",
                'line' => DB::raw("(GeomFromText('" .
                    new MultiPoint([
                        new Point(-8.373883, 114.159279, 4326),
                        new Point(-8.38999, 114.144079, 4326)
                    ])
                    . "'))")
            ],
        ]);
    }
}