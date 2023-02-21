<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use MatanYadaev\EloquentSpatial\Objects\LineString;
use MatanYadaev\EloquentSpatial\Objects\Point;

class HopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hops')->insert([
            [
                'connection_id' => 1,
                'qrcode' => 'RJ045',
                'line' => DB::raw("(GeomFromText('" . new LineString([
                    new Point(-7.276505575143712, 112.74529337882997, 4326),
                    new Point(-7.281629876393493, 112.74031519889833, 4326)
                ], 4326) . "'))")
            ],
            [
                'connection_id' => 1,
                'qrcode' => 'RJ046',
                'line' => DB::raw("(GeomFromText('" . new LineString([
                    new Point(-7.281629876393493, 112.74031519889833, 4326),
                    new Point(-7.2890102572049, 112.73605316877, 4326)
                ], 4326) . "'))")
            ]
        ]);
    }
}