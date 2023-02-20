<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use MatanYadaev\EloquentSpatial\Objects\LineString;
use MatanYadaev\EloquentSpatial\Objects\Point;

class WitelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('witels')->insert([
            [
                'name' => "Gubeng",
                'location' => DB::raw("(GeomFromText('" . new Point(-7.276505575143712, 112.74529337882997, 4326) . "'))")
            ],
            [
                'name' => "Darmo",
                'line' => DB::raw("(GeomFromText('" . new Point(-7.289010257204875, 112.73605316877367, 4326) . "'))")
            ],
        ]);
    }
}