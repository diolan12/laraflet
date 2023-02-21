<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use MatanYadaev\EloquentSpatial\Objects\Point;

class ConnectionBreakpointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('connection_breakpoints')->insert([
            [
                'connection_id' => 1,
                'point' => DB::raw("(GeomFromText('" . new Point(-7.281629876393493, 112.74031519889833, 4326) . "'))")
            ],
            // [
            //     'connection_id' => 1,
            //     'point' => DB::raw("(GeomFromText('" . new Point(-7.2821885972889895, 112.78088092803956, 4326) . "'))")
            // ]
        ]);
    }
}