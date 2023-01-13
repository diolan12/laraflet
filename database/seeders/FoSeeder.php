<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use MatanYadaev\EloquentSpatial\Objects\LineString;
use MatanYadaev\EloquentSpatial\Objects\Point;

class FoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fos')->insert([
            [
                'name' => "RJ01",
                'cable_line' => DB::raw("(GeomFromText('" .
                    new LineString([
                        new Point(-7.279379022306316, 112.76221275329591, 4326),
                        new Point(-7.288020537635671, 112.7638864517212, 4326)
                    ])
                    . "'))")
            ],
            [
                'name' => "RJ44",
                'cable_line' => DB::raw("(GeomFromText('" .
                    new LineString([
                        new Point(-7.299982163071488, 112.76247024536134, 4326),
                        new Point(-7.288020537635671, 112.7638864517212, 4326)
                    ])
                    . "'))")
            ],
        ]);
    }
}