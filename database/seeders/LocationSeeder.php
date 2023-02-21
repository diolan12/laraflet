<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use MatanYadaev\EloquentSpatial\Objects\Point;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('locations')->insert([
            [
                'name' => "Gubeng",
                'abbreviation' => "GBG",
                'type' => "sto",
                'point' => DB::raw("(GeomFromText('" . new Point(-7.276505575143712, 112.74529337882997, 4326) . "'))")
            ], 
            [
                'name' => "Darmo",
                'abbreviation' => "DMO",
                'type' => "sto",
                'point' => DB::raw("(GeomFromText('" . new Point(-7.289010257204875, 112.73605316877367, 4326) . "'))")
            ],
            [
                'name' => "Manyar",
                'abbreviation' => "MYR",
                'type' => "sto",
                'point' => DB::raw("(GeomFromText('" . new Point(-7.2851019163914374, 112.78142273426057, 4326) . "'))")
            ],
            [
                'name' => "Ketintang",
                'abbreviation' => "KTT",
                'type' => "sto",
                'point' => DB::raw("(GeomFromText('" . new Point(-7.309964128775075, 112.72710800170898, 4326) . "'))")
            ]
        ]);
    }
}
