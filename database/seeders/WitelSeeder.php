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
                'location' => DB::raw("(GeomFromText('" . new Point(-7.279379022306316, 112.76221275329591, 4326) . "'))")
            ],
            [
                'name' => "Rungkut",
                'line' => DB::raw("(GeomFromText('" . new Point(-7.299982163071488, 112.76247024536134, 4326) . "'))")
            ],
        ]);
    }
}