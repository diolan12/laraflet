<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class Points extends Seeder
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
        DB::table('points')->insert([
            [
                // 'latlng' => "-7.282004 112.780862",
                // 'latlng' => DB::raw("(GeomFromText('MULTIPOINT(37.774929 -122.419415, -7.282004 112.780862),4326'))"),
                'multi_id' => 1,
                'latitude' => -8.364409,
                'longitude' => 114.146513,
            ],
            [
                'multi_id' => 1,
                'latitude' => -8.364223388060376,
                'longitude' => 114.14744199589629,
            ],
            [
                'multi_id' => 1,
                'latitude' => -8.372725683803404,
                'longitude' => 114.1453672982199,
            ],
            [
                'multi_id' => 1,
                'latitude' => -8.378468078124511,
                'longitude' => 114.14610878648799,
            ],
            [
                'multi_id' => 1,
                'latitude' => -8.382713786521965,
                'longitude' => 114.1463877304072,
            ],
            [
                'multi_id' => 1,
                'latitude' => -8.38999,
                'longitude' => 114.144079,
            ],
            // [-8.38999, 114.144079],
            // [-8.392287688779126, 114.14516445109088],
            // [-8.392282, 114.145802]
            [
                'multi_id' => 2,
                'latitude' => -8.38999,
                'longitude' => 114.144079,
            ],
            [
                'multi_id' => 2,
                'latitude' => -8.392287688779126,
                'longitude' => 114.14516445109088,
            ],
            [
                'multi_id' => 2,
                'latitude' => -8.392282,
                'longitude' => 114.145802,
            ]
        ]);
    }
}